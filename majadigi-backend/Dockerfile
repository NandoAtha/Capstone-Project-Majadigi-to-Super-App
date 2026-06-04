FROM dunglas/frankenphp:php8.4

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        intl \
        zip \
        exif \
        pcntl \
    && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1


RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080



CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan module:list && \
    php artisan octane:frankenphp --host=0.0.0.0 --port=${PORT:-8080}