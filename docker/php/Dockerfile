FROM node:20.15.0-alpine3.20 AS node
FROM php:8.3-fpm-alpine3.20

# 開発環境でViteに接続するため
EXPOSE 5173
EXPOSE 9000

# PHPの依存関係をインストール
RUN apk add --no-cache \
  $PHPIZE_DEPS \
  zlib-dev \
  icu-libs \
  icu-dev \
  libzip-dev \
  libxml2-dev \
  oniguruma-dev \
  curl-dev \
  linux-headers \
  tzdata \
  php-mysqli \
  mysql-client \
  bash

# PHP拡張機能をインストール
RUN pecl install redis && \
  docker-php-ext-configure intl &&\
  docker-php-ext-enable redis && \
  docker-php-ext-install zip \
  intl \
  pdo_mysql \
  ctype \
  dom \
  fileinfo \
  filter \
  mbstring \
  pdo \
  session \
  xml

# 不要なパッケージを削除
RUN apk del $PHPIZE_DEPS linux-headers

# Composer install 2.7.2
COPY --from=composer:2.7.2 /usr/bin/composer /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

# Nodejs install 20.15.0
COPY --from=node /usr/local/bin /usr/local/bin
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules

WORKDIR /var/www/html

COPY . .
COPY ./docker/php/php.ini /usr/local/etc/php/

RUN chown -R www-data:www-data /var/www/html && \
  chmod 755 -R /var/www/html

CMD ["php-fpm", "-F"]
