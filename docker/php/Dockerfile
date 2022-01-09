FROM php:8.0

RUN apt-get update -y
RUN yes | apt-get upgrade -y
RUN apt-get install -y zlib1g-dev libxml2-dev libzip-dev libicu-dev libpng-dev git zip unzip
RUN docker-php-ext-install zip bcmath intl pdo dom mysqli pdo_mysql gd pcntl

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir '/usr/local/bin' --filename 'composer' --version 2.1.3
RUN php -r "unlink('composer-setup.php');"

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
