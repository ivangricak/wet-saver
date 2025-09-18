FROM php:8.2-fpm

# PHP залежності
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl supervisor libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql pgsql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Дозволяємо Composer працювати під root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Робоча директорія
WORKDIR /var/www
COPY . .

# Додаємо права для www-data перед Composer
RUN chown -R www-data:www-data /var/www

# Використовуємо www-data для Composer
USER www-data

# Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Frontend: Node + npm + sass
RUN npm install
RUN npm install --save-dev sass
RUN npm run build    # <-- build Vite для SCSS, CSS та JS

# Повертаємося до root для зміни прав
USER root

# Права на storage, bootstrap/cache та public/build
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public/build \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/public/build

# Відкритий порт
EXPOSE 8000

# Запуск Laravel з очищенням кешу і форсуванням HTTPS
CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan serve --host=0.0.0.0 --port=$PORT
