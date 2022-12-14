#!/bin/bash

# Author Elias Baya | elias@idaas.co.ke
# Used inside Bitbucket pipelines. Builds Laravel project and prepares it
# for testing. Creates an .env file from .env.pipelines.

# Install dependencies.
composer install --no-interaction
npm install

# Here we create link between the .env.pipelines file and the .env file.
ln -f -s .env.pipelines .env

# run your scripts.
php artisan migrate --no-interaction
php artisan key:generate
php artisan passport:install --uuids
php artisan db:seed

# Run npm build.
npm run prod