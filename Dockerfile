FROM php:8.1-apache

# Install PDO and extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working dir to /var/www/html
WORKDIR /var/www/html

# Copy Laravel to container
COPY . /var/www/html

# Change DocumentRoot to /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html
