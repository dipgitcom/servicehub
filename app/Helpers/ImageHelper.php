<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get the correct image URL for a service image
     *
     * @param string $imagePath
     * @return string
     */
    public static function getServiceImage($imagePath)
    {
        if (empty($imagePath)) {
            return asset('images/services/service-placeholder.jpg');
        }
        
        // Check if the path starts with 'public/'
        if (strpos($imagePath, 'public/') === 0) {
            // Remove 'public/' from the path
            $imagePath = str_replace('public/', '', $imagePath);
        }
        
        // Check if the path starts with 'storage/'
        if (strpos($imagePath, 'storage/') === 0) {
            return asset($imagePath);
        }
        
        // Check if the path starts with 'images/'
        if (strpos($imagePath, 'images/') === 0) {
            return asset($imagePath);
        }
        
        // Check if the path is a full URL
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }
        
        // Default: assume it's in storage
        if (Storage::disk('public')->exists($imagePath)) {
            return Storage::url($imagePath);
        }
        
        // If file doesn't exist in storage, check if it exists in public directory
        if (file_exists(public_path($imagePath))) {
            return asset($imagePath);
        }
        
        // If all else fails, return placeholder
        return asset('images/services/service-placeholder.jpg');
    }
}
