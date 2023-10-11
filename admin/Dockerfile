FROM php:8.2-fpm
ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install sockets

WORKDIR /app
COPY . .

RUN cd /app/admin && composer install

CMD php /app/admin/artisan serve --host=0.0.0.0
EXPOSE 8000
