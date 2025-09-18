FROM php:8.2-fpm

# Встановлюємо системні залежності і розширення PHP для MySQL та PostgreSQL
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl supervisor libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql pgsql

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Робоча директорія
WORKDIR /var/www
COPY . .

# Встановлюємо залежності Laravel
RUN composer install --no-dev --optimize-autoloader

# Frontend: Node.js + npm + sass
RUN npm install
RUN npm install --save-dev sass

# Збираємо assets через Vite (SCSS + CSS + JS)
RUN npm run build

# Очищення кешу Laravel, щоб manifest і конфігурації були актуальні
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Права на папки storage і bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Встановлюємо порт для Laravel
EXPOSE 8000

# Запуск Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
