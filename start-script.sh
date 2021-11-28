#!/bin/sh

cp .env.local .env
composer install
php -S 0.0.0.0:8000 public/index.php
