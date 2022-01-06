FROM roadiz/php80-nginx-alpine:latest
MAINTAINER Ambroise Maupate <ambroise@rezo-zero.com>
ARG USER_UID=1000
ENV APP_ENV=prod
ENV APP_DEBUG=0

RUN usermod -u ${USER_UID} www-data \
    && groupmod -g ${USER_UID} www-data

COPY docker/php-nginx-alpine/crontab.txt /crontab.txt
# Added Roadiz messenger for async tasks
COPY docker/php-nginx-alpine/supervisor.ini /etc/supervisor.d/services.ini
COPY docker/php-nginx-alpine/etc/nginx /etc/nginx
COPY docker/php-nginx-alpine/before_launch.sh /before_launch.sh
COPY --chown=www-data:www-data . /var/www/html/

RUN /usr/bin/crontab -u www-data /crontab.txt \
    && chmod +x /before_launch.sh

# Do not add volume for src/GeneratedEntity, they are versioned since Roadiz v2
VOLUME /var/www/html/var \
        /var/www/html/config/jwt \
       /var/www/html/public/files \
       /var/www/html/public/assets

ENTRYPOINT exec /usr/bin/supervisord -n -c /etc/supervisord.conf
