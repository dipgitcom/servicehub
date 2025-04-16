# PowerShell script to fix profile image issues

Write-Host "Fixing profile image issues..." -ForegroundColor Green

# Create directories if they don't exist
if (-not (Test-Path "public\images")) {
    New-Item -ItemType Directory -Path "public\images" -Force
}
if (-not (Test-Path "storage\app\public\profile-images")) {
    New-Item -ItemType Directory -Path "storage\app\public\profile-images" -Force
}

# Download a placeholder user image
Write-Host "Downloading placeholder user image..." -ForegroundColor Green
Invoke-WebRequest -Uri "https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" -OutFile "public\images\user-placeholder.jpeg"

# Create storage link if it doesn't exist
if (-not (Test-Path "public\storage")) {
    Write-Host "Creating storage link..." -ForegroundColor Green
    php artisan storage:link
} else {
    Write-Host "Storage link already exists." -ForegroundColor Yellow
}

# Clear cache
Write-Host "Clearing cache..." -ForegroundColor Green
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear

Write-Host "Profile image issues fixed successfully!" -ForegroundColor Green
