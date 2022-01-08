FROM php:7.4.27-apache

COPY ["docker/php-apache/000-default.conf", "/etc/apache2/sites-available/000-default.conf"]

# Update packages to latest version and install common dependencies
RUN apt update && apt upgrade -y
RUN apt install -y curl
RUN apt install -y libxml2-dev

# PHP install extension: gd and prerequisite
RUN apt install -y libfreetype6-dev
RUN apt install -y libpng-dev
RUN apt install -y libjpeg-dev
#RUN docker-php-ext-configure gd \
#    --with-freetype-dir=/usr/include/ \
#    --with-jpeg-dir=/usr/include/ \
#    --with-png-dir=/usr/include/
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN apt purge -y libfreetype6-dev libpng-dev libjpeg-dev

# PHP install extension: intl and prerequisite
RUN apt install -y libicu-dev
RUN docker-php-ext-install -j$(nproc)  intl
RUN apt-get purge -y libicu-dev

# Removed temporary file of APT
RUN rm /var/lib/apt/lists/* -R

RUN a2enmod rewrite
RUN docker-php-ext-install pdo
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql
#RUN docker-php-ext-install curl
RUN docker-php-ext-install json
RUN docker-php-ext-install opcache
#RUN docker-php-ext-install xml

# use your users $UID and $G`ID below
RUN groupadd apache-www-volume -g 1000
RUN useradd apache-www-volume -u 1000 -g 1000

RUN chown -R www-data:www-data /var/www

# Automatically run by php/httpd containers
CMD ["apache2-foreground"]

RUN if [ $DEVEL = "true" ] ; then \
  php /var/www/html/bin/console make:migration -n; \
  php /var/www/html/bin/console doctrine:migration:migrate -n; \
  php /var/www/html/bin/console doctrine:fixture:load -n; \
fi;