FROM php:8.2-apache

# Install PDO and extensions
RUN docker-php-ext-install pdo pdo_mysql
# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working dir to /var/www/html
WORKDIR /var/www/html
# Copy Laravel to container
COPY . /var/www/html

# Install Composer dan Dependencies Laravel
ARG APP_ENV=production
ENV APP_ENV=${APP_ENV}
RUN apt-get update && apt-get install -y unzip git \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

RUN if [ "$APP_ENV" = "production" ]; then \
      composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader ; \
    else \
      composer install --no-interaction --prefer-dist ; \
    fi


# Change DocumentRoot to /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html
# Menghilangkan warning
RUN echo "ServerName praytimenow.onrender.com" >> /etc/apache2/apache2.conf

RUN php artisan config:cache && php artisan route:cache
