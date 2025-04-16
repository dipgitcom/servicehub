# PowerShell script to set up default services data

Write-Host "Setting up default services data..." -ForegroundColor Green

# Run migrations if needed
php artisan migrate

# Seed the default services data
php artisan services:seed-default

# Create service images directory if it doesn't exist
if (-not (Test-Path "public\images\services")) {
    New-Item -ItemType Directory -Path "public\images\services" -Force
}

# Download service images
Write-Host "Downloading service images..." -ForegroundColor Green

# AC Doctor image
Invoke-WebRequest -Uri "https://images.unsplash.com/photo-1581578731548-c64695cc6952" -OutFile "public\images\services\ac-doctor.jpg"

# AC Servicing image
Invoke-WebRequest -Uri "https://images.unsplash.com/photo-1621905251189-08b45d6a269e" -OutFile "public\images\services\ac-servicing.jpg"

# AC Combo image
Invoke-WebRequest -Uri "https://images.unsplash.com/photo-1631646109206-4c33e4b5c2a1" -OutFile "public\images\services\ac-combo.jpg"

# Service placeholder image
Invoke-WebRequest -Uri "https://images.unsplash.com/photo-1581578731548-c64695cc6952" -OutFile "public\images\services\service-placeholder.jpg"

# Clear cache
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear

Write-Host "Default services data setup completed successfully!" -ForegroundColor Green
