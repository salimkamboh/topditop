FROM ubuntu:16.04

ENV DEBIAN_FRONTEND noninteractive

## Install php supervisor
RUN apt update && \
    apt install -y php-fpm php-cli php-gd php-mcrypt php-mysql php-curl php-mbstring php-xml \
                       nginx \
                       curl \
                       zip \
                       nano \
                       supervisor

RUN sed -i 's/^listen\s*=.*$/listen = 127.0.0.1:9000/' /etc/php/7.0/fpm/pool.d/www.conf && \
    sed -i 's/^\;error_log\s*=\s*syslog\s*$/error_log = \/var\/log\/php\/cgi.log/' /etc/php/7.0/fpm/php.ini && \
    sed -i 's/^\;error_log\s*=\s*syslog\s*$/error_log = \/var\/log\/php\/cli.log/' /etc/php/7.0/cli/php.ini

COPY files/root /

COPY src /var/www/html

RUN curl -sS https://getcomposer.org/installer | php

RUN mv composer.phar /usr/local/bin/composer

RUN cd /var/www/html && composer install

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]