FROM php:8.0-apache
RUN docker-php-ext-install mysqli
RUN apt-get update
RUN apt-get install -y libzip-dev zip
RUN docker-php-ext-install zip

COPY php.ini $PHP_INI_DIR/php.ini

COPY site /var/www/html/

run mkdir /var/www/html/content/ || true

run chown 33:33 /var/www/html/content

# COPY . /var/www/html/
