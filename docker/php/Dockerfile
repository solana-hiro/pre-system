FROM php:8.2-fpm
COPY php.ini /usr/local/etc/php/

RUN apt-get update\
    && apt-get install -y zlib1g-dev mariadb-client vim libzip-dev git nodejs npm\
  libpng-dev\
  libjpeg62-turbo-dev\
  && docker-php-ext-configure gd --with-jpeg\
  && docker-php-ext-install -j$(nproc) zip gd pdo_mysql bcmath
#Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin

WORKDIR /var/www

RUN composer global require "laravel/installer"
