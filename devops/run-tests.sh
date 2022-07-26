#!/bin/bash

# Author Elias Baya | elias@idaas.co.ke
# Start server & give time to start.
# & flag used to start server and continue, otherwise it will pause.
php artisan serve &
sleep 5

# run PHP Unit Tests
./vendor/bin/phpunit