#!/usr/bin/env bash

[ -f /var/www/html/storage/logs/laravel.log ] || touch /var/www/html/storage/logs/laravel.log
[ -f /var/www/html/storage/logs/laravel.log ] || touch /var/www/html/storage/logs/php-cgi.log
[ -f /var/www/html/storage/logs/laravel.log ] || touch /var/www/html/storage/logs/php-cli.log

chown -R www-data:www-data /var/www /var/log/php

exec /usr/bin/supervisord --nodaemon -c /etc/supervisor/supervisord.conf