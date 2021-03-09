FROM alpine:latest


VOLUME ["/sys/"]
RUN apk update \
&& apk add openrc \
&& apk add influxdb \
&& apk add vim \
&& apk add curl \
&& rc-status -s \
&& apk add telegraf --repository http://nl.alpinelinux.org/alpine/edge/community \
&& touch /run/openrc/softlevel

COPY srcs/check.sh /

#setup telegraf
RUN sed -i 's/# database = "telegraf"/database = "influxdb"/gi' /etc/telegraf.conf

#start infludb server
CMD service telegraf start && influxd
#CMD sh
