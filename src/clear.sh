#!/bin/sh

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
# composer dump-autoload

