ARG PHP_VERSION=8.3.13
ARG MYSQL_VERSION=8.0.40
ARG SOLR_VERSION=9
ARG VARNISH_VERSION=7.1
ARG USER_UID=1000

#######
# PHP #
#######

FROM php:${PHP_VERSION}-fpm-bookworm AS php

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com"

ARG USER_UID

ARG COMPOSER_VERSION=2.8.1
ARG PHP_EXTENSION_INSTALLER_VERSION=2.6.0
ARG PHP_EXTENSION_REDIS_VERSION=6.1.0

SHELL ["/bin/bash", "-e", "-o", "pipefail", "-c"]

ENV APP_FFMPEG_PATH=/usr/bin/ffmpeg
ENV MYSQL_HOST=db
ENV MYSQL_PORT=3306

HEALTHCHECK --start-period=30s --interval=1m --timeout=6s CMD bin/console monitor:health -q

COPY --link docker/php/crontab.txt /crontab.txt
COPY --link docker/php/wait-for-it.sh /wait-for-it.sh
COPY --link docker/php/fpm.d/www.conf   ${PHP_INI_DIR}-fpm.d/zz-www.conf

RUN <<EOF
apt-get --quiet update
apt-get --quiet --yes --purge --autoremove upgrade
# Packages - System
apt-get --quiet --yes --no-install-recommends --verbose-versions install \
    less \
    sudo \
    cron \
    ffmpeg
rm -rf /var/lib/apt/lists/*

usermod -u ${USER_UID} www-data
groupmod -g ${USER_UID} www-data
echo "www-data ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/www-data

/usr/bin/crontab -u www-data /crontab.txt
chmod +x /wait-for-it.sh
chown -R www-data:www-data /var/www/html

# Php extensions
curl -sSLf  https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions \
    --output /usr/local/bin/install-php-extensions
chmod +x /usr/local/bin/install-php-extensions
install-php-extensions \
    @composer-${COMPOSER_VERSION} \
    amqp \
    bcmath \
    exif \
    fileinfo \
    gd \
    gmp \
    iconv \
    intl \
    json \
    mbstring \
    opcache \
    openssl \
    pcntl \
    pdo_mysql \
    simplexml \
    soap \
    xsl \
    zip \
    redis-${PHP_EXTENSION_REDIS_VERSION}
EOF

WORKDIR /var/www/html

###################
# PHP Development #
###################

FROM php AS php-dev

ENV APP_ENV=dev
ENV APP_RUNTIME_ENV=dev
ENV APP_DEBUG=1

# Configs
RUN ln -sf ${PHP_INI_DIR}/php.ini-development ${PHP_INI_DIR}/php.ini
COPY --link docker/php/conf.d/php.dev.ini ${PHP_INI_DIR}/conf.d/zz-app.ini
COPY --link --chmod=755 docker/php/docker-php-entrypoint-dev /usr/local/bin/docker-php-entrypoint
COPY --link --chmod=755 docker/php/docker-cron-entrypoint-dev /usr/local/bin/docker-cron-entrypoint

RUN <<EOF
apt-get --quiet update
apt-get --quiet --yes --purge --autoremove upgrade
# Packages - System
apt-get --quiet --yes --no-install-recommends --verbose-versions install \
    make \
    git
rm -rf /var/lib/apt/lists/*
EOF

VOLUME /var/www/html

USER www-data


##################
# PHP Production #
##################

FROM php AS php-prod

# If you want to use a private repository, you can use a deploy token
#ARG COMPOSER_DEPLOY_TOKEN

ENV APP_ENV=prod
ENV APP_RUNTIME_ENV=prod
ENV APP_DEBUG=0

# Use production PHP configuration for maximum performances
# but you won't be able to edit node-type without restarting docker app
## Configs
RUN ln -sf ${PHP_INI_DIR}/php.ini-production ${PHP_INI_DIR}/php.ini
COPY --link docker/php/conf.d/php.prod.ini ${PHP_INI_DIR}/conf.d/zz-app.ini
COPY --link --chmod=755 docker/php/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint
COPY --link --chmod=755 docker/php/docker-cron-entrypoint /usr/local/bin/docker-cron-entrypoint

USER www-data

# Composer
COPY --link --chown=www-data:www-data composer.* symfony.* .
RUN <<EOF
# If you want to use a private repository, you can use a deploy token
#composer config gitlab-token.gitlab.com ${COMPOSER_DEPLOY_TOKEN}
composer install --no-cache --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress
EOF

COPY --link --chown=www-data:www-data . .

RUN <<EOF
composer dump-autoload --classmap-authoritative --no-dev
bin/console cache:warmup --no-optional-warmers
bin/console assets:install
bin/console themes:assets:install Rozier
chmod 0755 /var/www/html/bin/console
chmod 0750 /var/www/html
chmod 0750 \
    /var/www/html/bin \
    /var/www/html/config \
    /var/www/html/docker \
    /var/www/html/migrations \
    /var/www/html/public \
    /var/www/html/src \
    /var/www/html/templates \
    /var/www/html/translations \
    /var/www/html/var \
    /var/www/html/vendor
chown www-data:www-data /var/www/html
EOF

VOLUME /var/www/html/config/jwt \
       /var/www/html/config/secrets \
       /var/www/html/public/files \
       /var/www/html/public/assets \
       /var/www/html/var/files


#########
# Nginx #
#########

FROM roadiz/nginx-alpine AS nginx-prod

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com"

COPY --link --from=php-prod --chown=www-data:www-data /var/www/html/public /var/www/html/public


#########
# MySQL #
#########

FROM mysql:${MYSQL_VERSION} AS mysql

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com"

ARG USER_UID

SHELL ["/bin/bash", "-e", "-o", "pipefail", "-c"]

RUN <<EOF
usermod -u ${USER_UID} mysql
groupmod -g ${USER_UID} mysql
echo "USER_UID: ${USER_UID}\n"
EOF

COPY --link docker/mysql/performances.cnf /etc/mysql/conf.d/performances.cnf

########
# Solr #
########

FROM solr:${SOLR_VERSION}-slim AS solr

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com"

ARG USER_UID

SHELL ["/bin/bash", "-e", "-o", "pipefail", "-c"]

USER root

RUN <<EOF
set -ex
echo "USER_UID: ${USER_UID}\n"
usermod -u ${USER_UID} "$SOLR_USER"
groupmod -g ${USER_UID} "$SOLR_GROUP"
chown -R ${USER_UID}:${USER_UID} /var/solr
EOF

COPY --link docker/solr/managed-schema.xml /opt/solr/server/solr/configsets/_default/conf/managed-schema

USER $SOLR_USER

# Redeclare VOLUME to change permissions
VOLUME /var/solr


###########
# Varnish #
###########

FROM varnish:${VARNISH_VERSION}-alpine AS varnish

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com"

ENV VARNISH_SIZE 512G

COPY --link docker/varnish/default.vcl /etc/varnish/
