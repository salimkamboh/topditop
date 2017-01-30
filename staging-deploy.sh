#!/usr/bin/env bash

eval $(docker-machine env topditop-production)

docker-compose -f docker-compose-staging.yml -p topditop-staging up -d

docker-machine ssh topditop-production -A 'cd /home/deployer/apps/topditop-staging && git checkout develop && git pull origin develop'

docker exec -it topditopstaging_web_1 /bin/bash -c 'cd /var/www/html/ && /usr/local/bin/composer install'

docker exec -it topditopstaging_web_1 /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan migrate --force'

eval $(docker-machine env --unset)