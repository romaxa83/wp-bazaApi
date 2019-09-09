#!/bin/bash

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

chmod 777 -R /var/www/api/var
php composer.phar install -d /var/www/api
php composer.phar update -d /var/www/api
cp /var/www/api/.env.example /var/www/api/.env

php /var/www/api/bin/app.php migrations:migrate --no-interaction