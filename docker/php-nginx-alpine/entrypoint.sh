#!/usr/bin/env sh

echo "-----------------------"
echo "--   Before launch   --"
echo "-----------------------"
/before_launch.sh ;
echo "-----------------------"
echo "-- Supervisor launch --"
echo "-----------------------"
/usr/bin/supervisord -n -c /etc/supervisord.conf ;
