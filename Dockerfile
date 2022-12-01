FROM php:8.0-apache
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y libxml2-dev
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install soap && docker-php-ext-enable soap