# Use official PHP with Apache
FROM php:8.2-apache

# Install PostgreSQL PDO extension
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Enable Apache rewrite module (if you’re using .htaccess)
RUN a2enmod rewrite

# Copy your project files into the web root
COPY . /var/www/html/

# Fix permissions (optional)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80
