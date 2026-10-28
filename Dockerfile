FROM ubuntu:24.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    software-properties-common \
    curl \
    git \
    unzip

RUN add-apt-repository ppa:ondrej/php -y && apt-get update

RUN apt-get install -y \
    nginx \
    php8.3 \
    php8.3-cli \
    php8.3-fpm \
    php8.3-bcmath \
    php8.3-curl \
    php8.3-mbstring \
    php8.3-xml \
    php8.3-zip \
    php8.3-mysql \
    php8.3-pgsql \
    php8.3-sqlite3 \
    php8.3-gd \
    php8.3-redis \
    php8.3-intl \
    php8.3-opcache \
    php8.3-dom \
    php8.3-pdo \
    php8.3-tokenizer \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get update

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Setup workdir
WORKDIR /var/www/html

# Copy data to workdir
COPY ./app .

# Setup storage path permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    /var/www/html/bootstrap/cache

RUN sed -i 's|listen = /run/php/php8.3-fpm.sock|listen = 9000|g' /etc/php/8.3/fpm/pool.d/www.conf && \
    sed -i 's|;listen.allowed_clients = 127.0.0.1|listen.allowed_clients = 127.0.0.1|g' /etc/php/8.3/fpm/pool.d/www.conf

# Configure ports
EXPOSE 80

CMD ["sh", "-c", "php-fpm8.3 -F & nginx -g 'daemon off;'"]