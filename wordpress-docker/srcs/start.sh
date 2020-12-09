#!/bin/sh
echo "daemon off;" >> /etc/nginx/nginx.conf
echo "error_log stderr;" >> /etc/nginx/nginx.conf
#rc-service mariadb setup
#rc-service mariadb start
#mysql  -e "CREATE DATABASE wordpress"
#mysql  -e "GRANT ALL PRIVILEGES ON wordpress.* TO 'wp'@'localhost' IDENTIFIED BY 'wp123'"
#mysql -e "FLUSH PRIVILEGES"
#nc mysql:3306
rc-service php-fpm7 start
rc-service nginx start
#sh
