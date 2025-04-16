#!/bin/bash
# Script to create service-related images

echo "Creating service images..."

# Create directories if they don't exist
mkdir -p public/images/services

# Download service images
echo "Downloading service images..."

# AC Doctor image
curl -s https://images.unsplash.com/photo-1581578731548-c64695cc6952 -o public/images/services/ac-doctor.jpg

# AC Servicing image
curl -s https://images.unsplash.com/photo-1621905251189-08b45d6a269e -o public/images/services/ac-servicing.jpg

# AC Combo image
curl -s https://images.unsplash.com/photo-1631646109206-4c33e4b5c2a1 -o public/images/services/ac-combo.jpg

# Service placeholder image
curl -s https://images.unsplash.com/photo-1581578731548-c64695cc6952 -o public/images/services/service-placeholder.jpg

echo "Service images created successfully!"
