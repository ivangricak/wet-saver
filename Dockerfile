FROM php:8.2-fpm

# Встановлюємо системні залежності і розширення PHP для MySQL та PostgreSQL
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl supervisor libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql pgsql

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Робоча директорія
WORKDIR /var/www
COPY . .

# Встановлюємо залежності Laravel
RUN composer install --no-dev --optimize-autoloader

# Права на папки
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Порт
EXPOSE 8000

# Запуск Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
