FROM php:7.4-cli

# Install php and dependencies
RUN apt-get update && apt-get install -y \
       unzip \
       libzip-dev \
    && docker-php-ext-install zip \
    && docker-php-source delete

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

WORKDIR /var/www