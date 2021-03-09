FROM alpine:latest

VOLUME ["/sys/"]
RUN apk update \
&& apk add \
 vsftpd\
 vim \
 ncftp \
 openrc\
 openssl \
&& rc-status -s \
&& touch /run/openrc/softlevel \
&& apk add telegraf --repository http://nl.alpinelinux.org/alpine/edge/community

COPY srcs/check.sh /

#setup telegraf.
RUN sed -i 's/# urls = \["http:\/\/127.0.0.1:8086"\]/urls = \
\["http:\/\/influxdb:8086"\]/gi' /etc/telegraf.conf \
&& sed -i 's/# database = "telegraf"/database = "ftps"/gi' /etc/telegraf.conf

#create user who will have access to ftp server.
RUN mv /etc/vsftpd/vsftpd.conf /etc/vsftpd/vsftpd.conf.backup \
&& printf "abdelali\nabdelali\n" | adduser abdelali \
&& touch /etc/vsftpd.userlist && echo "abdelali" >> /etc/vsftpd.userlist \
&& mkdir /home/abdelali/ftp && chown nobody:nogroup home/abdelali/ftp/ \
&& mkdir /home/abdelali/ftp/files \
&& touch /home/abdelali/ftp/files/test-ftp \
&& chown -R abdelali:abdelali /home/abdelali/ftp/files

#setup ssl, create public and private key.
RUN openssl req -x509 -nodes -newkey rsa:4096 -keyout /etc/ssl/private/key.pem \
 -out /etc/ssl/certs/cert.pem -days 365 -subj "/C=MA/ST=Kh/L=Kh/O=1337/CN=abdelali"

#create file to test ftp connection.
RUN echo "Hi from ftps-docker" > /home/abdelali/ftp/files/test-ftp
COPY ./srcs/vsftpd.conf /etc/vsftpd/

ARG FTPS_IP
ENV FTPS_IP=${FTPS_IP}
#start vsftpd server
RUN sed -i "s/FTPS_IP/$FTPS_IP/gi" /etc/vsftpd/vsftpd.conf
CMD service telegraf start && vsftpd /etc/vsftpd/vsftpd.conf
