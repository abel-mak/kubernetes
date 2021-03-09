FROM alpine:latest

VOLUME ["/sys/"]
RUN apk update \
&& apk add openrc \
&& apk add nginx \
&& apk add openssl \
&& apk add openssh \
&& apk add vim \
&& rc-status -s \
&& touch /run/openrc/softlevel \
&& apk add telegraf --repository http://nl.alpinelinux.org/alpine/edge/community


COPY srcs/default.conf /etc/nginx/conf.d/
COPY srcs/nginx.conf /etc/nginx/
COPY srcs/check.sh /

#setup telegraf
RUN sed -i 's/# urls = \["http:\/\/127.0.0.1:8086"\]/urls = \
\["http:\/\/influxdb:8086"\]/gi' /etc/telegraf.conf \
&& sed -i 's/# database = "telegraf"/database = "nginx"/gi' /etc/telegraf.conf

RUN printf "abdelali\nabdelali\n" | adduser abdelali

#setup ssl
RUN openssl req -x509 -nodes -newkey rsa:4096 -keyout /etc/ssl/private/key.pem \
 -out /etc/ssl/certs/cert.pem -days 365 -subj "/C=MA/ST=Kh/L=Kh/O=1337/CN=abdelali" 

ARG IP
ENV IP=${IP}
RUN sed -i "s/IP/$IP/g" /etc/nginx/nginx.conf \
&& sed -i "s/IP/$IP/g" /etc/nginx/conf.d/default.conf

CMD echo "daemon off;" >> /etc/nginx/nginx.conf \
&& service telegraf start \
&& service sshd start \
&& service nginx start
