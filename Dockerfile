FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

# Install PHP extensions
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd mysqli pdo pdo_mysql && \
    rm -rf /var/lib/apt/lists/*

# Expose port 80
EXPOSE 80

# Optionally, you might want to enable mod_rewrite if you use it
RUN a2enmod rewrite
