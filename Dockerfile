FROM php:8.2-fpm

# PHP залежності
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl supervisor libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql pgsql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Робоча директорія
WORKDIR /var/www
COPY . .

# Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Frontend
RUN npm install
RUN npm install --save-dev sass
RUN npm run build    # <-- build для Vite

# Права
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Відкритий порт
EXPOSE 8000

# Запуск Laravel з очищенням кешу при старті
CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan serve --host=0.0.0.0 --port=$PORT
