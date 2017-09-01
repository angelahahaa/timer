#!/bin/bash
# script to creat new php docker container
# made to run in docker container
php_dir=$(pwd) #directory of php files
port='82'
name='timer'

RED='\033[0;31m'
NC='\033[0m'
BLUE='\033[0;34m'

printf "${RED}========== PULL PUBLIC APACHE BASE PHP IMAGE as 'base' ==========${NC} \n"
docker pull webgriffe/php-apache-base
docker tag webgriffe/php-apache-base base

printf "${RED}============ Run Container as ${name} at port ${port} ============${NC} \n"
docker run -v $php_dir:/var/www/html -p $port:80 --name $name -d base
printf "${RED}======================== Enter Docker bash ========================${NC} \n"
printf "${RED}
run in docker bash:${BLUE}

run 'all_in_one.bash' in docker bash to get basic tools and start mysql
or manually install and start mysql-server:
${NC}apt-get install mysql-server
service mysql start
"
printf "${RED}===================================================================${NC} \n"
docker exec -it $name /bin/bash

