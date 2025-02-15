#!/bin/bash
cd /var/www/html && php artisan key:generate && php artisan migrate --force
a2enmod rewrite
apache2-foreground