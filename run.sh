#!/bin/bash

cd /var/www/symfony
sleep 3
php bin/console doctrine:database:create --env=test
php bin/console doctrine:migrations:migrate --env=test --no-interaction
php bin/console doctrine:fixtures:load --env=test --no-interaction
bin/phpunit
