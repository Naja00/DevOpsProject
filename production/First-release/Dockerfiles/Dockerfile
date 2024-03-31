# Use an existing Apache image with PHP support as a base
FROM php:apache

# Update and install required system packages
RUN apt-get update && apt-get install -y \
    libpng-dev \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Update Composer to version 2
RUN composer self-update --2

# Install PHPMailer
RUN composer require phpmailer/phpmailer

# Install the MySQLi extension
RUN docker-php-ext-install mysqli

# Set the working directory in the container
WORKDIR /var/www/html

# Copy HTML and PHP files from the host into the container
COPY First-release/. .

# Expose port 80 to the outside world
EXPOSE 80
