FROM alpine:latest

VOLUME ["/sys/"]
RUN apk update \
&& apk add vsftpd\
&& apk add vim \
&& apk add ncftp \
&& apk add openrc\
&& apk add openssl \
&& rc-status -s \
&& touch /run/openrc/softlevel
RUN mv /etc/vsftpd/vsftpd.conf /etc/vsftpd/vsftpd.conf.backup
RUN printf "abdelali\nabdelali\n" | adduser abdelali
RUN touch /etc/vsftpd.userlist && echo "abdelali" >> /etc/vsftpd.userlist
RUN mkdir /home/abdelali/ftp && chown nobody:nogroup home/abdelali/ftp/
RUN mkdir /home/abdelali/ftp/files \
&& touch /home/abdelali/ftp/files/test-ftp \
&& chown -R abdelali:abdelali /home/abdelali/ftp/files
RUN openssl req -x509 -nodes -newkey rsa:4096 -keyout /etc/ssl/private/key.pem -out /etc/ssl/certs/cert.pem -days 365 -subj "/C=MA/ST=Kh/L=Kh/O=1337/CN=abdelali"
RUN echo "Hi from ftps-docker" > /home/abdelali/ftp/files/test-ftp
COPY ./srcs/vsftpd.conf /etc/vsftpd/

### ALERT!!! workaound to set ip as env of container
## to build i must run 
## new: docker build --build-arg MKUBE_IP=$(kubectl get svc | grep ftps | cut -d " " -f 16) ftps-docker/ -t ftps-docker

## old: docker build --build-arg MKUBE_IP=$(minikube ip) ftps-docker/ -t ftps-docker
ARG MKUBE_IP
ENV MKUBE_IP=${MKUBE_IP}
#######
RUN sed -i "s/MKUBE_IP/$MKUBE_IP/gi" /etc/vsftpd/vsftpd.conf
#CMD vsftpd /etc/vsftpd/vsftpd.conf
CMD vsftpd /etc/vsftpd/vsftpd.conf
#EXPOSE 30030-30030
#EXPOSE 21
#Ressources:
# https://www.digitalocean.com/community/tutorials/how-to-set-up-vsftpd-for-a-user-s-directory-on-ubuntu-16-04
#https://medium.com/learn-or-die/build-a-ftp-server-on-gcp-vm-with-vsftpd-e140f81da575
# https://www.ncftp.com/ncftp/doc/ncftp.html
# https://serverfault.com/questions/574722/vsftp-error-500-oops-child-died
# (a worked for me) https://stackoverflow.com/questions/4723023/vsftpd-error-listing-directories
#on ftp ip range probleme
#Avec le mode passif après la connection sur le port 21 le serveur FTP 
#va dire au client sur quel port se fera le transfert de donnée, tu doit donc
#avoir une plage min/max de port dispo dans ta config vsftpd et ces mêmes 
#ports doivent être redirigé via dockerfile et le yaml, vérifie peut 
#être que ces ports sont bien renseignés partou

