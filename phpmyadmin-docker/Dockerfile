FROM alpine:latest

VOLUME ["sys"]
RUN apk update
RUN apk add openrc vim nginx php7 php7-fpm php7-mysqli php7-mbstring\
 php7-json php7-session 
RUN ln -sf -sf /dev/stdout /var/log/nginx/error.log
RUN mv /etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf.backup
COPY srcs/default.conf /etc/nginx/conf.d/
RUN rm -rf /etc/php7/php-fpm.d/www.conf 
COPY srcs/www.conf /etc/php7/php-fpm.d/
RUN rc-status -s
RUN touch /run/openrc/softlevel
RUN wget https://files.phpmyadmin.net/phpMyAdmin/4.9.4/phpMyAdmin-4.9.4-english.tar.xz
RUN tar -xf phpMyAdmin-4.9.4-english.tar.xz
RUN mv phpMyAdmin-4.9.4-english phpmyadmin
RUN mv phpmyadmin /var/www/html 
RUN echo "daemon off;" >> /etc/nginx/nginx.conf
COPY srcs/config.inc.php /var/www/html/
COPY srcs/start.sh /
RUN chmod 700 /start.sh
CMD ./start.sh
