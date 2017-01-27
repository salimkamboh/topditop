#!/usr/bin/env bash

exec eval $(docker-machine env topditop-production)

exec docker-compose -f docker-compose-production.yml up -d

exec docker exec -it topditop_web_1 /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan migrate --force'

exec eval $(docker-machine env --unset)