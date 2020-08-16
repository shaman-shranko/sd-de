FROM php:7.2-apache

RUN docker-php-ext-install mysqli \
 && docker-php-ext-install pdo \
 && docker-php-ext-install pdo_mysql \
 && docker-php-ext-enable mysqli \
 && docker-php-ext-enable pdo \
 && docker-php-ext-enable pdo_mysql

#RUN cd /usr/src \
# && apt-get update \
# && apt-get install -y curl git \
# && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD . /var/www/html
ADD ./docker/up.sh /up.sh
RUN chmod 777 /up.sh


WORKDIR /var/www/html

EXPOSE 80

RUN a2enmod rewrite