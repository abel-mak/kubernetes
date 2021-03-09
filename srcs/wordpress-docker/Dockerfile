FROM alpine:latest

VOLUME ["/sys/"]
RUN apk update
RUN apk add \
 openrc \
 grep \ 
 nginx \
 curl \
 vim \
 php7 \
 php7-fpm \
 php7-mysqli \
 php7-mbstring \
 mysql \
 mysql-client \
 php7-json \
&& rc-status -s \
&& touch /run/openrc/softlevel \
&& apk add telegraf --repository http://nl.alpinelinux.org/alpine/edge/community

COPY srcs/check.sh /

#setup telegraf
RUN sed -i 's/# urls = \["http:\/\/127.0.0.1:8086"\]/urls = \
\["http:\/\/influxdb:8086"\]/gi' /etc/telegraf.conf \
&& sed -i 's/# database = "telegraf"/database = "wordpress"/gi' /etc/telegraf.conf

RUN cat etc/nginx/conf.d/default.conf
RUN mv etc/nginx/conf.d/default.conf etc/nginx/conf.d/default.conf.backup
COPY srcs/info.php /var/www/html/
#RUN ln -sf /dev/stdout /var/log/nginx/error.log
COPY srcs/wp-config.php /var/www/html/
RUN rm -rf /etc/php7/php-fpm.d/www.conf
COPY srcs/www.conf /etc/php7/php-fpm.d/

RUN wget https://wordpress.org/latest.tar.gz && tar -xf latest.tar.gz \
&& cp -r wordpress/. /var/www/html/
COPY srcs/default.conf /etc/nginx/conf.d/

#this command below is  to create /run/openrc directory 
#RUN rc-status -s \
#&& touch /run/openrc/softlevel

CMD service telegraf start \
#&&./start.sh 
&& echo "daemon off;" >> /etc/nginx/nginx.conf \
&& echo "error_log stderr;" >> /etc/nginx/nginx.conf \
&& service php-fpm7 start \
&& service nginx start
