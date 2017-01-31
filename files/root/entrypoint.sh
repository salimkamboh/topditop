#!/usr/bin/env bash

mkdir -p "/var/www/html/storage/logs"
mkdir -p "/var/www/html/storage/framework/cache"
mkdir -p "/var/www/html/storage/framework/sessions"
mkdir -p "/var/www/html/storage/framework/views"
mkdir -p "/var/log/letsencrypt"

[ -f /var/www/html/storage/logs/laravel.log ] || touch /var/www/html/storage/logs/laravel.log
[ -f /var/www/html/storage/logs/php-cgi.log ] || touch /var/www/html/storage/logs/php-cgi.log
[ -f /var/www/html/storage/logs/php-cli.log ] || touch /var/www/html/storage/logs/php-cli.log
[ -f /var/log/letsencrypt/letsencrypt.log ] || touch /var/log/letsencrypt/letsencrypt.log
[ -f /var/log/cron.log ] || touch /var/log/cron.log

cd /var/www/html/ && composer install

sh /check_cert.sh

chown -R www-data:www-data /var/www

exec /usr/bin/supervisord --nodaemon -c /etc/supervisor/supervisord.conf