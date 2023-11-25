# Use an official PHP image with Apache as a base image
FROM gcr.io/google-appengine/php:8.0

# Install required dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath soap

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

# Copy the rest of the application code to the container
COPY . .

# Set the storage and bootstrap/cache directories permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose the PORT environment variable for Google Cloud Run
ENV PORT 8080

# Start the Apache server with the proper port
CMD ["apache2-foreground"]
