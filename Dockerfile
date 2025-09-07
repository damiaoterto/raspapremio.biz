FROM php:8.4-apache

COPY ./docker/php/custom.ini /usr/local/etc/php/conf.d/

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    graphviz

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring zip exif pcntl curl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN pecl install mongodb && docker-php-ext-enable mongodb

COPY ./.htaccess .htaccess
COPY ./docker/apache/apache-custom.conf /etc/apache2/conf-available/apache-custom.conf

RUN a2enconf apache-custom
RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www/html/
COPY ./composer.json ./composer.lock ./

RUN composer install

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
