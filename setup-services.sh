#!/bin/bash
# Script to set up services data

echo "Setting up services data..."

# Run migrations if needed
php artisan migrate

# Seed the services data
php artisan services:seed

# Create service images
bash create-service-images.sh

# Clear cache
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear

echo "Services data setup completed successfully!"
