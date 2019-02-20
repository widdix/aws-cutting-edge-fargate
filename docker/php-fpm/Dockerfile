FROM php:7.3-fpm-stretch

# FIXME RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql
RUN chown www-data:www-data /var/www/html/

COPY --chown=www-data:www-data src/ /var/www/html/
