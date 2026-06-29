FROM php:8.4.1-fpm

# Установка необходимых пакетов
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libpq-dev

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    pdo_pgsql \
    pgsql \
    intl \
    sockets \
    opcache

#Pecl installation
RUN pecl install --onlyreqdeps --force redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Установка Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install

# Установка рабочего окружения
WORKDIR /var/www/html/backend

# Установка прав
RUN chown -R www-data:www-data /var/www/html/backend

# Переменные окружения
ENV APACHE_DOCUMENT_ROOT /var/www/html/backend/public
EXPOSE 9000

CMD ["php-fpm"]