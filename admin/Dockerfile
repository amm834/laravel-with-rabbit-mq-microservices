FROM php:8.2-fpm as php
RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

FROM composer:latest AS composer

WORKDIR /app

COPY database/ database/
COPY composer.json composer.json
COPY composer.lock composer.lock

COPY . .

RUN composer install

CMD php artisan serve --host=0.0.0.0
EXPOSE 8000

