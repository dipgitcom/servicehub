# PowerShell script to set up services data

Write-Host "Setting up services data..." -ForegroundColor Green

# Run migrations if needed
php artisan migrate

# Seed the services data
php artisan services:seed

# Create service images
# Instead of using bash script, we'll download images directly
Write-Host "Creating service images..." -ForegroundColor Green

# Create directories if they don't exist
if (-not (Test-Path "public\images\services")) {
    New-Item -ItemType Directory -Path "public\images\services" -Force
}

# Download service images using PowerShell
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

Write-Host "Services data setup completed successfully!" -ForegroundColor Green
