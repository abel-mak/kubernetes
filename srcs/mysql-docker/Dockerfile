FROM alpine:latest

VOLUME ["/sys/"]
RUN echo "http://nl.alpinelinux.org/alpine/edge/community" \
 >> /etc/apk/repositories 
 RUN apk update \
 && apk add \
 openrc \
 mysql \
 mariadb-server-utils\
 telegraf \
 mysql-client \
 vim \
 && rc-status -s \
 && touch /run/openrc/softlevel

COPY srcs/create_tables.sql /
COPY srcs/wordpress.sql /
COPY srcs/check.sh /
#setup telegraf
RUN sed -i 's/# urls = \["http:\/\/127.0.0.1:8086"\]/urls = \
 \["http:\/\/influxdb:8086"\]/gi' /etc/telegraf.conf \
&& sed -i 's/# database = "telegraf"/database = "mysql"/gi' /etc/telegraf.conf

#setup mysql, create databases and users.
CMD service mariadb setup \
&& service telegraf start \
&& sed -i 's/skip-networking/#skip-networking/g' /etc/my.cnf.d/mariadb-server.cnf \
&& sed -i 's/#bind-address=0.0.0.0/bind-address=0.0.0.0/g' /etc/my.cnf.d/mariadb-server.cnf \
&& cat /etc/my.cnf.d/mariadb-server.cnf \ 
&& rc-service mariadb start \
&& mysql -e "SET GLOBAL general_log = 'ON';" \
&& mysql -e "SET GLOBAL slow_query_log = 'ON';" \
&& mysql  -e "CREATE DATABASE IF NOT EXISTS wordpress" \
&& mysql  -e "GRANT ALL PRIVILEGES ON wordpress.* TO 'wp'@'%wordpress%' IDENTIFIED BY 'wp123'" \
&& mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'abel'@'%phpmyadmin%' IDENTIFIED BY 'abel123'" \
&& mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY '' WITH GRANT OPTION;" \
&& mysql -e "FLUSH PRIVILEGES" \
&& mysql < create_tables.sql \
&& mysql < wordpress.sql \
&& service mariadb stop \
&& mysqld -u root
