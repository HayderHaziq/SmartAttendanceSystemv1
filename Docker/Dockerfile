# Use the official PHP image
FROM php:8.0-apache

# Set the working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get install -y libzip-dev zip && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install zip

# Copy the Laravel application files
COPY . .

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev

# Expose port 8080
EXPOSE 8080

# Start the Apache server
CMD ["apache2-foreground"]