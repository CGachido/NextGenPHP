FROM php:8.3-fpm-alpine

RUN apk add --no-cache postgresql-dev

RUN docker-php-ext-install pdo_pgsql opcache 

RUN apk update \
  && apk add build-base autoconf \
  && apk add linux-headers

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

RUN apk del build-base autoconf \
  && apk cache clean