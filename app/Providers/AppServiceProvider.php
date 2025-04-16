<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        
        // Set default string length for MySQL older than 5.7.7
        Schema::defaultStringLength(191);
        
        // Add version to assets to prevent caching
        $this->app->bind('asset.version', function () {
            return time();
        });
        
        // Make sure storage link exists
        if (!file_exists(public_path('storage'))) {
            try {
                symlink(storage_path('app/public'), public_path('storage'));
            } catch (\Exception $e) {
                // Handle exception if needed
            }
        }
        
        // Create a custom blade directive for service images
        Blade::directive('serviceImage', function ($expression) {
            return "<?php echo \App\Helpers\ImageHelper::getServiceImage($expression); ?>";
        });
    }
}
