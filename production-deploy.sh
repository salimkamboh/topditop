#!/usr/bin/env bash

eval $(docker-machine env topditop-production)

docker-compose -f docker-compose-production.yml -p topditop up -d

docker-machine ssh topditop-production -A 'cd /home/deployer/apps/topditop-production && git checkout develop'

docker exec -it topditop_web_1 /bin/bash -c 'cd /var/www/html/ && /usr/local/bin/composer install'

docker exec -it topditop_web_1 /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan migrate --force'

eval $(docker-machine env --unset)