#!/usr/bin/env bash

display_help()
{
    echo "Following params must be defined:
        env: docker machine environment
        compose_file: compose file to use
        project_name: the name of the project - must be different for staging and production if using same machine for deployment
        web_container: web container that is going to be used to run laravel commands for cleanup and caching
        branch: git branch which to deploy
        remote_deploy_path: path where to put git source"
}

check_var()
{
    local var_name=$1
    local var_value=$2

    if [[ ! ${var_value} ]]; then
        echo "Variable ${var_name} is not defined."
        display_help
        exit 1;
    fi
}

check_var "env" ${env}
check_var "compose_file" ${compose_file}
check_var "project_name" ${project_name}
check_var "web_container" ${web_container}
check_var "branch" ${branch}
check_var "remote_deploy_path" ${remote_deploy_path}

echo "Deploying with params:
    env: ${env}
    compose_file: ${compose_file}
    project_name: ${project_name}
    web_container: ${web_container}
    branch: ${branch}
    remote_deploy_path: ${remote_deploy_path}"

eval $(docker-machine env ${env})

docker-compose -f ${compose_file} -p ${project_name} up -d

docker-machine ssh topditop-production -A "cd ${remote_deploy_path} && git checkout ${branch} && git pull origin ${branch}"

docker exec -it ${web_container} /bin/bash -c 'cd /var/www/html/ && /usr/local/bin/composer install'

docker exec -it ${web_container} /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan migrate --force'

docker exec -it ${web_container} /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan config:clear'

docker exec -it ${web_container} /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan cache:clear'

docker exec -it ${web_container} /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan debugbar:clear'

docker exec -it ${web_container} /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan route:clear'

docker exec -it ${web_container} /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan optimize'

docker exec -it ${web_container} /bin/bash -c 'cd /var/www/html/ && /usr/bin/php artisan top:sitemap:create'

eval $(docker-machine env --unset)