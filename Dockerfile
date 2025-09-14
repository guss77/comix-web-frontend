# Dockerfile for PHP web frontend

FROM php:8.2-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Copy application files
COPY backend/ /var/www/html/

# Set file permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
