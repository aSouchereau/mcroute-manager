#!/bin/sh

# Run migrations
php artisan migrate --force

# Remove startup script
rm -- "$0"
