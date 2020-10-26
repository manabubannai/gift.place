#!/usr/bin/env bash

touch /var/app/current/.env

APP_NAME=$(/opt/elasticbeanstalk/bin/get-config environment -k APP_NAME)
DB_CONNECTION=$(/opt/elasticbeanstalk/bin/get-config environment -k DB_CONNECTION)
DB_HOST=$(/opt/elasticbeanstalk/bin/get-config environment -k DB_HOST)
DB_PORT=$(/opt/elasticbeanstalk/bin/get-config environment -k DB_PORT)
DB_DATABASE=$(/opt/elasticbeanstalk/bin/get-config environment -k DB_DATABASE)
DB_USERNAME=$(/opt/elasticbeanstalk/bin/get-config environment -k DB_USERNAME)
DB_PASSWORD=$(/opt/elasticbeanstalk/bin/get-config environment -k DB_PASSWORD)

printf "APP_NAME=${APP_NAME}\nDB_CONNECTION=${DB_CONNECTION}\nDB_HOST=${DB_HOST}\nDB_PORT=${DB_PORT}\nDB_DATABASE=${DB_DATABASE}\nDB_USERNAME=${DB_USERNAME}\nDB_PASSWORD=${DB_PASSWORD}" > /var/app/current/.env

