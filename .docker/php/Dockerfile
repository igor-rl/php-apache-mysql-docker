FROM php:8.2.3-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli && docker-php-ext-enable mysqli pdo pdo_mysql

RUN apt-get update && apt-get upgrade -y