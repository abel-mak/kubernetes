FROM alpine:latest

VOLUME ["/sys/"]

#to install grafana add http://nl.alpinelinux.org/alpine/edge/testing 
#in /etc/apk/repositories file
RUN echo "http://nl.alpinelinux.org/alpine/edge/testing" \
 >> /etc/apk/repositories \
 && echo "http://nl.alpinelinux.org/alpine/edge/community" \
 >> /etc/apk/repositories \
&& apk update \
&& apk add \
	openrc \
	curl \
	vim \
	grafana \
	syslog-ng \
&& rc-status -s \
&& touch /run/openrc/softlevel \
&& apk add telegraf 

#copy dashboard and datasouce configurations. 
COPY srcs/check.sh /
COPY srcs/dashboards /usr/share/grafana/conf/provisioning/dashboards/
COPY srcs/datasources /usr/share/grafana/conf/provisioning/datasources/
RUN mkdir /grafana_dashboards
COPY srcs/grafana_dashboards/ /grafana_dashboards
RUN chown -R grafana:grafana /usr/share/grafana/

#setup telegraf.
RUN sed -i 's/# urls = \["http:\/\/127.0.0.1:8086"\]/urls = \
 \["http:\/\/influxdb:8086"\]/gi' /etc/telegraf.conf \
&& sed -i 's/# database = "telegraf"/database = "grafana"/gi' /etc/telegraf.conf

#start telegraf & grafana
CMD service telegraf start \ 
&& cd /usr/share/grafana/conf && grafana-server
