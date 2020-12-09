FROM alpine

VOLUME ["/sys/"]
#php7-json extension for wordpress (error: Uncaught Error: Call to undefined function json_decode())
RUN apk add openrc grep nginx curl vim less php7 php7-fpm php7-mysqli php7-mbstring \
mysql mysql-client php7-json
RUN cat etc/nginx/conf.d/default.conf
RUN mv etc/nginx/conf.d/default.conf etc/nginx/conf.d/default.conf.backup
COPY srcs/info.php /var/www/html/
RUN ln -sf /dev/stdout /var/log/nginx/error.log
COPY srcs/wp-config.php /var/www/html/
#in www.confi: nginx is default user used by nginx
#user:nginx
#group:nginx
#listen.owner = nginx
#listen.group = nginx
#listen:/var/run/php-fpm7/php-fpm7.sock
#The "session" extension is missing. Please check your PHP co....
#solution: innstall php7-session
RUN rm -rf /etc/php7/php-fpm.d/www.conf
COPY srcs/www.conf /etc/php7/php-fpm.d/

RUN wget https://wordpress.org/latest.tar.gz && tar -xf latest.tar.gz \
&& cp -r wordpress/. /var/www/html/
COPY srcs/default.conf /etc/nginx/conf.d/
#RUN mkdir /run/openrc 
#this command below is  to create /run/openrc directory 
RUN rc-status -s 
RUN touch /run/openrc/softlevel
COPY srcs/start.sh /
RUN chmod 700 /start.sh
CMD ./start.sh 
EXPOSE 80
