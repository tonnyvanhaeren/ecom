FROM tonnyvanhaeren/php:7.2.3

WORKDIR /var/www/html

ADD . /var/www/html

RUN docker-php-ext-install mbstring pdo pdo_mysql mysqli 
