FROM php:8.4.12-fpm-alpine3.21

WORKDIR /var/www

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apk update && apk add --no-cache \
    $PHPIZE_DEPS \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www

RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data /var/www

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
