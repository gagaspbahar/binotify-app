FROM php:8.0-apache
COPY . /var/www/html

RUN apt-get update

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo pdo_pgsql

RUN [ ! -f /usr/local/etc/php/php.ini-production ] || sed -E -i -e 's/post_max_size = 8M/post_max_size = 10M/' /usr/local/etc/php/php.ini-production
    
RUN [ ! -f /usr/local/etc/php/php.ini-production ] || sed -E -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 10M/' /usr/local/etc/php/php.ini-production

RUN [ ! -f /usr/local/etc/php/php.ini-production ] || mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN apt-get install -y mp3info

RUN apt-get install -y ffmpeg

RUN service apache2 restart