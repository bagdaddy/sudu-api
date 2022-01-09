FROM php:8.0-fpm

RUN apt-get update
RUN yes | apt-get upgrade
RUN apt-get install -y zlib1g-dev libxml2-dev libzip-dev libicu-dev libpng-dev git zip unzip
RUN docker-php-ext-install zip bcmath intl pdo dom mysqli pdo_mysql gd pcntl

ARG XDEBUG_ENABLE=0
RUN if [ ${XDEBUG_ENABLE} = 1 ]; then \
    yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=docker.for.mac.localhost" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.max_nesting_level=2048" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_handler="dbgp"" >> /usr/local/etc/php/conf.d/xdebug.ini \
;fi

WORKDIR /var/www/html
