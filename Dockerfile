# Use an official PHP image with Apache as a base image
FROM php:8.0.30-apache

# Install required dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath soap gd

# Enable Apache modules
RUN a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock ./

# Install Laravel dependencies
RUN composer install --no-interaction --no-plugins --no-scripts

# Download and install Cloud SQL Auth Proxy
RUN curl -o cloud_sql_proxy https://dl.google.com/cloudsql/cloud_sql_proxy.linux.amd64 && chmod +x cloud_sql_proxy

# Copy the rest of the application code to the container
COPY . .

# Set the storage and bootstrap/cache directories permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Start the Cloud SQL Auth Proxy and Apache server
CMD ["./cloud_sql_proxy", "-instances=nodal-suprstate-405304:asia-southeast1:smartattendancesystem=tcp:3306", "&", "apache2-foreground"]