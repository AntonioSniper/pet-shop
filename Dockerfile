FROM php:8.2-apache

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Включение mod_rewrite для Apache
RUN a2enmod rewrite

# Копирование всех файлов проекта
COPY . /var/www/html

# Установка прав на папки storage и bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Установка зависимостей PHP
RUN composer install --no-dev --optimize-autoloader

# Установка зависимостей Node.js и сборка фронтенда (если есть)
RUN npm install && npm run build || true

# Открываем порт 80
EXPOSE 80

# Запуск Apache
CMD ["apache2-foreground"]
