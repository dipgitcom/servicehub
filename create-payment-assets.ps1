# PowerShell script to create payment-related assets

Write-Host "Creating payment assets..." -ForegroundColor Green

# Create directories if they don't exist
if (-not (Test-Path "public\images")) {
    New-Item -ItemType Directory -Path "public\images" -Force
}

# Download payment method logos
Write-Host "Downloading payment method logos..." -ForegroundColor Green

# Google Pay logo
Invoke-WebRequest -Uri "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Google_Pay_Logo.svg/512px-Google_Pay_Logo.svg.png" -OutFile "public\images\google-pay-logo.png"

# Visa logo
Invoke-WebRequest -Uri "https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/512px-Visa_Inc._logo.svg.png" -OutFile "public\images\visa-logo.png"

# Mastercard logo
Invoke-WebRequest -Uri "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/512px-Mastercard-logo.svg.png" -OutFile "public\images\mastercard-logo.png"

# bKash logo
Invoke-WebRequest -Uri "https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Bkash_logo.png/320px-Bkash_logo.png" -OutFile "public\images\bkash-logo.png"

Write-Host "Payment assets created successfully!" -ForegroundColor Green
