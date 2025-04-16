#!/bin/bash
# Create a symbolic link from public/storage to storage/app/public

echo "Creating storage symbolic link..."

# Create the symbolic link
php artisan storage:link

echo "Storage link created successfully!"
echo "Now your uploaded files will be accessible from the web."
