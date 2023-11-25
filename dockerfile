# Use the official PHP 8.0 image
FROM php:8.0

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the Laravel application files to the container
COPY . /var/www/html

# Install dependencies
RUN apt-get update \
    && apt-get install -y \
        libonig-dev \
        libxml2-dev \
        unzip \
        curl \
        libzip-dev \
        zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache zip

# Expose port 8080 for Google Cloud Run (although it's not necessary in this case)
EXPOSE 8080

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
