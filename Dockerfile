# Use the official PHP image with Apache
FROM php:8.2-apache

# Copy all your project files into the Apache web directory
COPY . /var/www/html/

# Set file permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable Apache rewrite module (optional if you're using .htaccess)
RUN a2enmod rewrite

# Expose port 80 (Render uses this internally)
EXPOSE 80
