FROM serversideup/php:8.4-fpm-nginx-alpine AS base

USER root

FROM base AS dev

USER root

ARG USER_ID
ARG GROUP_ID

RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID \
    && docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx

USER www-data

FROM base AS prod

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer 

COPY composer.json composer.lock ./

RUN composer install --no-dev --no-interaction --no-progress --optimize-autoloader

COPY --chown=www-data:www-data . /var/www/html
