#!/bin/sh
/root/welcome.sh &
mailcatcher --no-quit --foreground --ip=0.0.0.0 --smtp-port=25 --http-port=80 --http-path $HTTPPATH
