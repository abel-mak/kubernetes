FROM alpine:latest

VOLUME ["/sys/"]
RUN apk update \
 && apk add openrc mysql mariadb-server-utils mysql-client vim\
 && rc-status -s \
 && touch /run/openrc/softlevel
CMD rc-service mariadb setup \
&& sed -i 's/skip-networking/#skip-networking/g' /etc/my.cnf.d/mariadb-server.cnf \
&& sed -i 's/#bind-address=0.0.0.0/bind-address=0.0.0.0/g' /etc/my.cnf.d/mariadb-server.cnf \
#&& echo "[client]" >> /etc/my.cnf.d/mariadb-server.cnf \
#&& echo "user=root" >> /etc/my.cnf.d/mariadb-server.cnf \
#&& echo "password=toor" >> /etc/my.cnf.d/mariadb-server.cnf \
&& cat /etc/my.cnf.d/mariadb-server.cnf \
&& rc-service mariadb start \
&& mysql -e "SET GLOBAL general_log = 'ON';" \
&& mysql -e "SET GLOBAL slow_query_log = 'ON';" \
&& mysql  -e "CREATE DATABASE IF NOT EXISTS wordpress" \
&& mysql  -e "GRANT ALL PRIVILEGES ON wordpress.* TO 'wp'@'%wordpress%' IDENTIFIED BY 'wp123'" \
&& mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'abel'@'%phpmyadmin-svc%' IDENTIFIED BY 'abel123'" \
&& mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY '' WITH GRANT OPTION;" \
&& mysql -e "FLUSH PRIVILEGES" \
&& service mariadb stop \
&& mysqld -u root
