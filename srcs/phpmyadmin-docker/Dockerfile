FROM alpine:latest

VOLUME ["/sys/"]
RUN apk update
RUN apk add openrc \
 vim \
 nginx\
 php7 \
 php7-mysqli\
 php7-mbstring\
 php7-json php7-session \
&& apk add telegraf --repository http://nl.alpinelinux.org/alpine/edge/community \
&& apk add php7-fpm

COPY srcs/check.sh /

#setup telegraf
RUN sed -i 's/# urls = \["http:\/\/127.0.0.1:8086"\]/urls = \
\["http:\/\/influxdb:8086"\]/gi' /etc/telegraf.conf \
&& sed -i 's/# database = "telegraf"/database = "phpmyadmin"/gi' /etc/telegraf.conf


#download phpmyadmin and setup nginx.
RUN  mv /etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf.backup \
&& rm -rf /etc/php7/php-fpm.d/www.conf \
&& rc-status -s \
&& touch /run/openrc/softlevel \
&& wget https://files.phpmyadmin.net/phpMyAdmin/4.9.4/phpMyAdmin-4.9.4-english.tar.xz \
&& tar -xf phpMyAdmin-4.9.4-english.tar.xz \
&& mv phpMyAdmin-4.9.4-english phpmyadmin \
&& mv phpmyadmin /var/www/html \ 
&& mkdir /var/www/html/tmp \
&& chown -R nginx:nginx /var/www/html/tmp \
&& echo "daemon off;" >> /etc/nginx/nginx.conf

#copy nginx and phpmyadmin configuration files
COPY srcs/default.conf /etc/nginx/conf.d/
COPY srcs/www.conf /etc/php7/php-fpm.d/

#copy phpmyadmin configuration files
COPY srcs/config.inc.php /var/www/html/
#COPY srcs/start.sh /

#RUN chmod 700 /start.sh
CMD service telegraf start \
#&& ./start.
&& rc-service php-fpm7 start \
&& rc-service nginx start
