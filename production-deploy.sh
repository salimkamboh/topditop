#!/usr/bin/env bash

env=${env:-topditop-production}
compose_file=${compose_file:-docker-compose-production.yml}
project_name=${project_name:-topditop}
web_container=${web_container:-topditop_web_1}
branch=${branch:-master}
remote_deploy_path=${remote_deploy_path:-/home/deployer/apps/topditop-production}

source ./base-deploy.sh