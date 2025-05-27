FROM php:8.1-apache

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy project files
COPY . /var/www/html/

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set permissions (opsional)
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 80
