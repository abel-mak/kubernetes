FROM alpine:latest


VOLUME ["/sys/"]
RUN apk update \
&& apk add openrc \
&& apk add influxdb \
&& apk add vim \
&& apk add curl \
&& rc-status -s \
&& touch /run/openrc/softlevel

CMD influxd
#CMD sh
