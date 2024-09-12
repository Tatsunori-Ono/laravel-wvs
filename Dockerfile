# Use PHP 8.2 with Apache
FROM php:8.2-apache AS laravel

# Set working directory
WORKDIR /var/www

# Install system dependencies and PHP extensions for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    pkg-config \
    zip \
    curl \
    git \
    unzip \
    npm \
    vim \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy the Laravel app code to the container (after Composer install)
COPY . /var/www

# Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Install Node.js dependencies for Vite
RUN cd /var/www && npm install && npm run build

# Set Apache DocumentRoot to /var/www/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port 80 for web traffic
EXPOSE 80

# Start Apache and serve the Laravel app
CMD ["apache2-foreground"]

RUN composer install --no-interaction

RUN php artisan config:clear
RUN npm run build
