#!/bin/bash
set -e
cd /var/www/html
cp .env.template .env
printenv | sed 's/\(^[^=]*\)=\(.*\)/\1="\2"/' | grep BAJO_ | sed 's/BAJO_//' >> .env
composer install
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
php bin/console doctrine:fixtures:load --no-interaction

if [ "${1#-}" != "$1" ]; then
        set -- apache2-foreground "$@"
fi

exec "$@"