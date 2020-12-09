FROM alpine:latest

VOLUME ["/sys/"]
RUN apk update \
&& apk add openrc \
&& apk add nginx \
&& apk add vim \
&& rc-status -s \
&& touch /run/openrc/softlevel

CMD sh
#Reference
# reverse proxy
# https://admantium.medium.com/nginx-as-a-reverse-proxy-38ed79762a7c
# https://stackoverflow.com/questions/25187817/nginx-reverse-proxy-images-and-css-are-not-loaded
