FROM wordpress:6.4-php8.2-apache

# Install additional PHP extensions and tools
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/wp-cli/v2.8.1/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# Set working directory
WORKDIR /var/www/html

# Copy WordPress configuration
COPY wp-config.php /var/www/html/

# Create necessary directories
RUN mkdir -p /var/www/html/wp-content/themes/custom \
    && mkdir -p /var/www/html/wp-content/plugins/custom \
    && chown -R www-data:www-data /var/www/html

# Copy custom theme and plugins
COPY ./wp-content/ /var/www/html/wp-content/

EXPOSE 80