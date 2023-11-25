# Use the official PHP image as a base image
FROM php:8.0

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the Laravel application files to the container
COPY . /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        git \
        libonig-dev \
        libxml2-dev \
        unzip \
        curl \
        libzip-dev \
        zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache zip 

# Expose port 8080 to the outside world
EXPOSE 8080

# Start the Laravel development server
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]
