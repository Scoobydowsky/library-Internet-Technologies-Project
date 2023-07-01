FROM php:8.2.7-apache-bullseye
RUN docker-php-ext-install mysqli opcache pdo_mysql && docker-php-ext-enable mysqli opcache pdo_mysql
RUN a2enmod rewrite
RUN apt-get update
RUN apt-get install curl git zip unzip -y
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY docker.entrypoint.sh /docker.entrypoint.sh
RUN chmod +x /docker.entrypoint.sh
ENTRYPOINT [ "/docker.entrypoint.sh"]
WORKDIR /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]