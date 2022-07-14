FROM php:fpm-alpine

RUN apk update && \
    apk add autoconf libc-dev gcc make && \
    cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# install composer
RUN curl -sSL https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# important php extensions
RUN docker-php-ext-install pdo_mysql

# install pecl_http package
RUN apk add zlib-dev curl-dev libevent-dev libidn2-dev libidn-dev icu-dev && \
    pecl install raphf && docker-php-ext-enable raphf && \
    pecl install pecl_http && echo "extension=http.so" > /usr/local/etc/php/conf.d/http.ini

RUN apk add php8-opcache && docker-php-ext-enable opcache

# install & configure xdebug
RUN pecl install xdebug && echo "zend_extension=xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini