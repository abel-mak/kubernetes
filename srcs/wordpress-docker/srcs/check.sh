#!/bin/sh

ps > a && grep 'telegraf -config' a
state1=$?
netstat -nl | grep php-fpm7.sock
state2=$?
if [ $state1 != 0 ]; then
  exit 1
elif [ $state2 != 0 ]; then
  exit 1
else
  exit 0
fi
