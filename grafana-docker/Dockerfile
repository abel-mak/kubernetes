FROM alpine:latest

VOLUME ["/sys/"]
RUN echo "http://nl.alpinelinux.org/alpine/edge/testing" \
 >> /etc/apk/repositories \
&& apk update \
&& apk add openrc \
&& apk add curl \
&& apk add vim \
&& rc-status -s \
&& apk add grafana \
&& apk add syslog-ng \
&& apk add influxdb \
&& apk add telegraf \ 
&& touch /run/openrc/softlevel \
&& rm /etc/influxdb.conf \
&& rm /etc/telegraf.conf
#to install grafana add http://nl.alpinelinux.org/alpine/edge/testing 
#in /etc/apk/repositories file
#EXPOSE 3000
COPY srcs/influxdb.conf /etc/ 
COPY srcs/telegraf.conf /etc/ 
COPY srcs/influx.json /

RUN service influxdb start \
&& sleep 5 \
&& influx -execute "CREATE USER admin WITH PASSWORD 'admin' WITH ALL PRIVILEGES"
#&& service grafana start
#CMD sh
#&& curl http://localhost:3000/api/dashboards/db -X POST \
# -H "Authorization: Basic YWRtaW46YWRtaW4=" \
# -H "Content-Type: application/json" -d @influx.json 
CMD service telegraf start \ 
&& cd /usr/share/grafana/conf && grafana-server


# telegraf:https://devconnected.com/how-to-setup-telegraf-influxdb-and-grafana-on-linux/
#https://serhack.me/articles/monitoring-infrastructure-grafana-influxdb-connect
# %%%%% panel.json must have key value dashboard  %%%%%
#insert dashboard
#	NOTE: Authorization: Basic <base64(username:password)>
#	curl http://192.168.99.109:3000/api/dashboards/db -X POST 
#	-H "Authorization: Basic YWRtaW46YWRtaW4="  -H 
#	"Content-Type: application/json" -d @panel.json
#References
# grafana api https://grafana.com/docs/grafana/latest/http_api/dashboard/
# post json file with curl: https://gist.github.com/ungoldman/11282441
#libc6-compat
