#!/bin/sh

ps > a &&  grep 'telegraf -config' a
if [ $? != 0 ]; then
  exit 1
else
  exit 0
fi
