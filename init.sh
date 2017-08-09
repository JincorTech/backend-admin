#!/bin/bash
composer install
cp .env.example .env
php artisan key:generate
php artisan vendor:publish --tag=datatables --force
php artisan vendor:publish --tag=datatables-buttons --force