
FROM composer:latest AS composer
FROM php:7.4-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer

ARG USER_ID
ARG GROUP_ID

RUN apt-get update && apt-get install -y \
        git \
        curl \
        wget \
        zip \
        libfreetype6-dev \
        libonig-dev \
        libzip-dev \
        zlib1g-dev libicu-dev g++ --no-install-recommends libxml2-dev \
    && docker-php-ext-install mbstring zip xml

RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

WORKDIR /var/www

USER "${USER_ID}:${GROUP_ID}"

CMD ["php-fpm"]