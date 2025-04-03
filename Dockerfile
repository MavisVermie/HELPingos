FROM php:8.2-apache

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Enable mod_rewrite (optional for .htaccess)
RUN a2enmod rewrite

# Copy your project files
COPY . /var/www/html/

# Set file permissions (optional)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80
