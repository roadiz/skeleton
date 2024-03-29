FROM roadiz/php82-fpm-alpine:latest
MAINTAINER Ambroise Maupate <ambroise@rezo-zero.com>
ARG USER_UID=1000
ENV APP_ENV=prod
ENV APP_DEBUG=0
ENV APP_FFMPEG_PATH=/usr/bin/ffmpeg
ENV MYSQL_HOST=db
ENV MYSQL_PORT=3306

# Added ffmpeg to extract video files thumbnails
RUN apk add --no-cache ffmpeg

RUN usermod -u ${USER_UID} www-data \
    && groupmod -g ${USER_UID} www-data

#
# Use development PHP configuration if you need to
# edit your node-types in production / preproduction
#
#COPY docker/php-fpm-alpine/php.ini /usr/local/etc/php/php.ini
#
# Use production PHP configuration for maximum performances
# but you won't be able to edit node-type without restarting docker app
#
COPY docker/php-fpm-alpine/php.prod.ini /usr/local/etc/php/php.ini
COPY docker/php-fpm-alpine/crontab.txt /crontab.txt
COPY docker/php-fpm-alpine/wait-for-it.sh /wait-for-it.sh
COPY docker/php-fpm-alpine/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint
COPY --chown=www-data:www-data . /var/www/html/

RUN ln -s /var/www/html/bin/console /usr/local/bin/console \
    && /usr/bin/crontab -u www-data /crontab.txt \
    && chmod +x /wait-for-it.sh \
    && chmod +x /usr/local/bin/docker-php-entrypoint \
    && chown -R www-data:www-data /var/www/html/

VOLUME /var/www/html/config/jwt \
       /var/www/html/config/secrets \
       ##
       ## Do not add volume for src/GeneratedEntity, they are versioned since Roadiz v2
       ## Uncomment these if you DO want to persist and edit node-types on production env
       ##
       #/var/www/html/config/api_resources \
       #/var/www/html/src/Resources \
       #/var/www/html/src/GeneratedEntity \
       /var/www/html/public/files \
       /var/www/html/public/assets \
       /var/www/html/var/files \
       /var/www/html/var/secret
