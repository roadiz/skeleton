FROM roadiz/php81-fpm-alpine
MAINTAINER Ambroise Maupate <ambroise@rezo-zero.com>

ARG USER_UID=1000
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APP_ENV=dev
ENV APP_CACHE=0
ENV APP_FFMPEG_PATH=/usr/bin/ffmpeg
ENV MYSQL_HOST=db
ENV MYSQL_PORT=3306

RUN apk add --no-cache shadow make git ffmpeg \
    && usermod -u ${USER_UID} www-data \
    && groupmod -g ${USER_UID} www-data \
    && composer --version \
    && ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime \
    && "date" \
    && echo "USER_UID: ${USER_UID}\n" \
    && version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;")

# Display errors
ADD php.ini /usr/local/etc/php/php.ini
ADD crontab.txt /crontab.txt
ADD wait-for-it.sh /wait-for-it.sh
ADD docker-php-entrypoint /usr/local/bin/docker-php-entrypoint

VOLUME /var/www/html
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html/

RUN ln -s /var/www/html/bin/console /usr/local/bin/console \
    && /usr/bin/crontab -u www-data /crontab.txt \
    && chmod +x /wait-for-it.sh \
    && chmod +x /usr/local/bin/docker-php-entrypoint \
    && chown -R www-data:www-data /var/www/html/
