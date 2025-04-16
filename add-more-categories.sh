#!/bin/bash
# Script to add more service categories

echo "Adding more service categories to ServiceHub..."

# Run the command to add more categories
php artisan categories:add-more

# Clear cache
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear

echo "Additional service categories have been added successfully!"
