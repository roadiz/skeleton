ARG PHP_VERSION=8.4.10
ARG MYSQL_VERSION=8.0.42
ARG NGINX_VERSION=1.27.5
ARG MARIADB_VERSION=11.4.7
ARG SOLR_VERSION=9
ARG VARNISH_VERSION=7.6.3

ARG UID=1000
ARG GID=${UID}

####################
# PHP - FRANKENPHP #
####################

FROM dunglas/frankenphp:php${PHP_VERSION}-bookworm AS php-franken

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com, eliot@rezo-zero.com"

ARG UID
ARG GID
ARG COMPOSER_VERSION
ARG PHP_EXTENSION_REDIS_VERSION

SHELL ["/bin/bash", "-e", "-o", "pipefail", "-c"]

ENV SERVER_NAME=":80"
ENV SERVER_ROOT="/app/public"
ENV APP_FFMPEG_PATH=/usr/bin/ffmpeg

RUN <<EOF
apt-get --quiet update
apt-get --quiet --yes --purge --autoremove upgrade
# Packages - System
apt-get --quiet --yes --no-install-recommends --verbose-versions install \
    acl \
    less \
    sudo \
    git \
    ffmpeg
rm -rf /var/lib/apt/lists/*

# User
addgroup --gid ${UID} php
adduser --home /home/php --shell /bin/bash --uid ${UID} --gecos php --ingroup php --disabled-password php
echo "php ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/php

# App
install --verbose --owner php --group php --mode 0755 --directory /app

chown -R php:php /app

# Php extensions
install-php-extensions \
    @composer-${COMPOSER_VERSION} \
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
    xsl \
    zip \
    redis-${PHP_EXTENSION_REDIS_VERSION}

setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp

chown --recursive ${UID}:${GID} /data/caddy /config/caddy

EOF

ENTRYPOINT ["docker-php-entrypoint"]

WORKDIR /app

#######################
# Php - franken - Dev #
#######################

FROM php-franken AS php-dev-franken

ENV XDEBUG_MODE=off

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY --link --chmod=755 docker/frankenphp/docker-php-entrypoint-dev /usr/local/bin/docker-php-entrypoint
COPY --link docker/frankenphp/conf.d/app.dev.ini ${PHP_INI_DIR}/conf.d/zz-app.ini
COPY --link docker/frankenphp/Caddyfile.dev /etc/frankenphp/Caddyfile

CMD ["--config", "/etc/frankenphp/Caddyfile", "--adapter", "caddyfile"]

USER php

VOLUME /app

########################
# Php - franken - Prod #
########################

FROM php-franken AS php-prod-franken

ENV XDEBUG_MODE=off
ENV APP_ENV=prod
ENV APP_RUNTIME_ENV=prod
ENV APP_DEBUG=0
# Only enable Worker mode in production
ENV APP_RUNTIME=Runtime\\FrankenPhpSymfony\\Runtime
ENV FRANKENPHP_CONFIG="worker /app/public/index.php"

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --link --chmod=755 docker/frankenphp/docker-php-entrypoint-prod /usr/local/bin/docker-php-entrypoint
COPY --link docker/frankenphp/conf.d/app.prod.ini ${PHP_INI_DIR}/conf.d/zz-app.ini
COPY --link docker/frankenphp/Caddyfile /etc/frankenphp/Caddyfile

CMD ["--config", "/etc/frankenphp/Caddyfile", "--adapter", "caddyfile"]

USER php

# Composer
COPY --link --chown=php:php composer.* symfony.* ./
RUN <<EOF
# If you depend on private Gitlab repositories, you must use a deploy token and username
#composer config gitlab-token.gitlab.rezo-zero.com ${COMPOSER_DEPLOY_TOKEN_USER} ${COMPOSER_DEPLOY_TOKEN}
composer install --no-cache --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress
EOF

COPY --link --chown=php:php ./api .
COPY --link --chown=php:php --from=encore-build /app/public/static ./public/static

RUN <<EOF
composer dump-autoload --classmap-authoritative --no-dev
bin/console cache:warmup --no-optional-warmers
bin/console assets:install
EOF

HEALTHCHECK --start-period=30s --interval=1m --timeout=6s CMD bin/console monitor:health -q

VOLUME /app/config/jwt \
       /app/config/secrets \
       /app/public/files \
       /app/public/assets \
       /app/var/files

#######
# PHP #
#######

FROM php:${PHP_VERSION}-fpm-bookworm AS php

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com"

ARG UID

ARG COMPOSER_VERSION=2.8.9
ARG PHP_EXTENSION_REDIS_VERSION=6.1.0

SHELL ["/bin/bash", "-e", "-o", "pipefail", "-c"]

ENV APP_FFMPEG_PATH=/usr/bin/ffmpeg
ENV MYSQL_HOST=db
ENV MYSQL_PORT=3306

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
    git \
    cron \
    ffmpeg
rm -rf /var/lib/apt/lists/*

# User
addgroup --gid ${UID} php
adduser --home /home/php --shell /bin/bash --uid ${UID} --gecos php --ingroup php --disabled-password php
echo "php ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/php

# App
install --verbose --owner php --group php --mode 0755 --directory /app

/usr/bin/crontab -u php /crontab.txt
chmod +x /wait-for-it.sh
chown -R php:php /app

# Php extensions
curl -sSLf  https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions \
    --output /usr/local/bin/install-php-extensions
chmod +x /usr/local/bin/install-php-extensions
install-php-extensions \
    @composer-${COMPOSER_VERSION} \
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
    xsl \
    zip \
    redis-${PHP_EXTENSION_REDIS_VERSION}
EOF

WORKDIR /app

###################
# PHP Development #
###################

FROM php AS php-dev

# If you depend on private Gitlab repositories, you must use a deploy token and username
# to use composer commands inside you
#ARG COMPOSER_DEPLOY_TOKEN
#ARG COMPOSER_DEPLOY_TOKEN_USER="gitlab+deploy-token-1"

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
apt-get --quiet --yes --no-install-recommends --verbose-versions install make
rm -rf /var/lib/apt/lists/*
# Prepare folder to install composer credentials
install --owner=php --group=php --mode=755 --directory /home/php/.composer
EOF

VOLUME /app

USER php

# If you depend on private Gitlab repositories, you must use a deploy token and username
#RUN composer config --global gitlab-token.gitlab.rezo-zero.com ${COMPOSER_DEPLOY_TOKEN_USER} ${COMPOSER_DEPLOY_TOKEN}


##################
# PHP Production #
##################

FROM php AS php-prod

# If you depend on private Gitlab repositories, you must use a deploy token and username
#ARG COMPOSER_DEPLOY_TOKEN
#ARG COMPOSER_DEPLOY_TOKEN_USER="gitlab+deploy-token-1"

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
COPY --link --chmod=755 docker/php/docker-migrate-entrypoint /usr/local/bin/docker-migrate-entrypoint

USER php

# Composer
COPY --link --chown=php:php composer.* symfony.* ./
RUN <<EOF
# If you depend on private Gitlab repositories, you must use a deploy token and username
#composer config gitlab-token.gitlab.rezo-zero.com ${COMPOSER_DEPLOY_TOKEN_USER} ${COMPOSER_DEPLOY_TOKEN}
composer install --no-cache --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress
EOF

COPY --link --chown=php:php . .

RUN <<EOF
composer dump-autoload --classmap-authoritative --no-dev
bin/console cache:warmup --no-optional-warmers
bin/console assets:install
EOF

HEALTHCHECK --start-period=30s --interval=1m --timeout=6s CMD bin/console monitor:health -q

VOLUME /app/config/jwt \
       /app/config/secrets \
       /app/public/files \
       /app/public/assets \
       /app/var/files



#########
# Nginx #
#########

FROM nginx:${NGINX_VERSION}-bookworm AS nginx

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com"

ARG UID

SHELL ["/bin/bash", "-e", "-o", "pipefail", "-c"]

RUN <<EOF
# Packages
apt-get --quiet update
apt-get --quiet --yes --purge --autoremove upgrade
apt-get --quiet --yes --no-install-recommends --verbose-versions install \
    less \
    sudo
rm -rf /var/lib/apt/lists/*

# User
groupmod --gid ${UID} nginx
usermod --uid ${UID} nginx
echo "nginx ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/nginx

# App
install --verbose --owner nginx --group nginx --mode 0755 --directory /app
EOF

ENV NGINX_ENTRYPOINT_QUIET_LOGS=1
# Config
COPY --link docker/nginx/nginx.conf               /etc/nginx/nginx.conf
COPY --link docker/nginx/redirections.conf        /etc/nginx/redirections.conf
COPY --link docker/nginx/mime.types               /etc/nginx/mime.types
COPY --link docker/nginx/conf.d/_gzip.conf        /etc/nginx/conf.d/_gzip.conf
COPY --link docker/nginx/conf.d/_security.conf    /etc/nginx/conf.d/_security.conf
COPY --link docker/nginx/conf.d/default.conf  /etc/nginx/conf.d/default.conf

WORKDIR /app



##############
# Nginx DEV  #
##############

FROM nginx AS nginx-dev

# Silence entrypoint logs

# Declare a volume for development
VOLUME /app



##############
# Nginx PROD #
##############

FROM nginx AS nginx-prod
# Copy public files from API
COPY --link --from=php-prod --chown=${USER_UID}:${USER_UID} /app/public /app/public

# Only enable healthcheck in production when the app is ready to serve requests on root path
# This could prevent Traefik or an ingress controller to route traffic to the app
#HEALTHCHECK --start-period=1m30s --interval=1m --timeout=6s CMD curl --fail -I http://localhost

#########
# MySQL #
#########

FROM mysql:${MYSQL_VERSION} AS mysql

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com eliot@rezo-zero.com"

ARG UID
ARG GID

SHELL ["/bin/bash", "-e", "-o", "pipefail", "-c"]

RUN <<EOF
usermod -u ${UID} mysql
groupmod -g ${GID} mysql
EOF

COPY --link docker/mysql/performances.cnf /etc/mysql/conf.d/performances.cnf

VOLUME /var/lib/mysql


#############
# MariaDB   #
#############

FROM mariadb:${MARIADB_VERSION} AS mariadb

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com eliot@rezo-zero.com"

ARG UID
ARG GID

# https://hub.docker.com/_/mariadb
# Using a custom MariaDB configuration file
# Custom configuration files should end in .cnf and be mounted read only at the directory /etc/mysql/conf.d
COPY --link --chmod=644 docker/mariadb/performances.cnf /etc/mysql/conf.d/performances.cnf

SHELL ["/bin/bash", "-e", "-o", "pipefail", "-c"]

RUN <<EOF
usermod -u ${UID} mysql
groupmod -g ${GID} mysql
EOF

VOLUME /var/lib/mysql


################
# Varnish      #
################

FROM varnish:${VARNISH_VERSION}-alpine AS varnish

LABEL org.opencontainers.image.authors="ambroise@rezo-zero.com eliot@rezo-zero.com"

ENV VARNISH_SIZE 256M

COPY --link docker/varnish/default.vcl /etc/varnish/
