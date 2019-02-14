#!/bin/sh

. ./config

docker build ./ -t gitorg2tw
docker run -d --name gitorg2tw -v `pwd`/html:/var/www/html -v `pwd`/config.php:/var/www/ -p ${PORT}:80 gitorg2tw
