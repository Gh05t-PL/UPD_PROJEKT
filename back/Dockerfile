FROM php:7.4-apache-buster

# add composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# host.docker.internal
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_host=192.1.8.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apt update && apt install -y git libzip-dev

RUN docker-php-ext-install pdo_mysql bcmath zip
RUN apt-get update && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install mongodb \
    &&  echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongo.ini

RUN a2enmod headers

WORKDIR /var/www/html/symfony
COPY . .
COPY ./apacheCFG /etc/apache2/sites-enabled
RUN composer install
RUN rm /etc/apache2/sites-enabled/000-default.conf
