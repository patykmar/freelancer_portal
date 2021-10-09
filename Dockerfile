FROM php:7.4.21-zts-alpine
WORKDIR /app
RUN apk add git
# install php7 intl dependecy
RUN apk add icu-dev
RUN docker-php-ext-configure intl && docker-php-ext-install intl
# install php7-gd with dependecy
RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev && \
  docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
  NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
  docker-php-ext-install -j$(nproc) gd && \
  apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev
RUN git clone https://github.com/patykmar/freelancer_portal.git app
RUN php -r 'echo "APP_SECRET=".md5(rand(1,time())); echo PHP_EOL;' >> /app/.env.local
RUN echo sendmail://default >> /app/.env.local
RUN curl -Ss getcomposer.org/installer | php
RUN php /composer.phar install
EXPOSE 8000
CMD php bin/console server:run 0.0.0.0:8000
