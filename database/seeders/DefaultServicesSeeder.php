<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceOption;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if the required columns exist
        $this->checkRequiredColumns();
        
        // First, make sure we have the AC Repair category
        $acCategory = ServiceCategory::where('slug', 'ac-repair-services')->first();
        
        if (!$acCategory) {
            $acCategory = ServiceCategory::create([
                'name' => 'AC Repair Services',
                'slug' => 'ac-repair-services',
                'description' => 'Professional AC repair and maintenance services',
                'icon' => 'fan',
                'status' => 1
            ]);
        }
        
        // Create AC Doctor Service
        $acDoctor = Service::create([
            'title' => 'AC Doctor',
            'slug' => 'ac-doctor',
            'description' => 'AC Doctor involves evaluating the energy usage of your air conditioning system to identify any inefficiencies and recommend measures to improve energy efficiency. This service helps optimize your AC\'s performance while reducing energy costs.',
            'price' => 449,
            'image' => 'images/services/ac-doctor.jpg',
            'category_id' => $acCategory->id,
            'is_featured' => 1,
            'status' => 1,
            'icon' => 'thermometer'
        ]);
        
        // AC Doctor Service Options
        ServiceOption::create([
            'service_id' => $acDoctor->id,
            'name' => '1-2 Ton',
            'description' => 'For AC units of 1-2 ton capacity',
            'price' => 449,
            'original_price' => 600,
            'status' => 1
        ]);
        
        ServiceOption::create([
            'service_id' => $acDoctor->id,
            'name' => '2.5-5 Ton',
            'description' => 'For AC units of 2.5-5 ton capacity',
            'price' => 449,
            'original_price' => 600,
            'status' => 1
        ]);
        
        // AC Servicing
        $acServicing = Service::create([
            'title' => 'AC Servicing',
            'slug' => 'ac-servicing',
            'description' => 'Professional AC servicing to ensure optimal performance and longevity of your air conditioning unit.',
            'price' => 1200,
            'image' => 'images/services/ac-repair.jpeg',
            'category_id' => $acCategory->id,
            'is_featured' => 1,
            'status' => 1,
            'icon' => 'tool'
        ]);
        
        // AC Servicing Options
        ServiceOption::create([
            'service_id' => $acServicing->id,
            'name' => 'Split AC',
            'description' => 'Servicing for split AC units',
            'price' => 1200,
            'original_price' => 1500,
            'status' => 1
        ]);
        
        ServiceOption::create([
            'service_id' => $acServicing->id,
            'name' => 'Window AC',
            'description' => 'Servicing for window AC units',
            'price' => 1000,
            'original_price' => 1300,
            'status' => 1
        ]);
        
        // AC Combo Packages
        $acCombo = Service::create([
            'title' => 'AC Combo Packages',
            'slug' => 'ac-combo-packages',
            'description' => 'Comprehensive AC maintenance packages that include multiple services at a discounted rate.',
            'price' => 2000,
            'image' => 'images/services/ac-combo.jpeg',
            'category_id' => $acCategory->id,
            'is_featured' => 1,
            'status' => 1,
            'icon' => 'package'
        ]);
        
        // AC Combo Options
        ServiceOption::create([
            'service_id' => $acCombo->id,
            'name' => 'Basic Package',
            'description' => 'Includes AC servicing and power consumption check',
            'price' => 2000,
            'original_price' => 2500,
            'status' => 1
        ]);
        
        ServiceOption::create([
            'service_id' => $acCombo->id,
            'name' => 'Premium Package',
            'description' => 'Includes AC servicing, power consumption check, and gas refill',
            'price' => 3000,
            'original_price' => 3800,
            'status' => 1
        ]);
        
        // Additional AC Services
        $additionalServices = [
            [
                'title' => 'AC Cooling Problem',
                'description' => 'Diagnostic and repair services for AC units that are not cooling properly.',
                'price' => 800,
                'icon' => 'thermometer-snow'
            ],
            [
                'title' => 'AC Exchange',
                'description' => 'Exchange your old AC for a new one with our convenient exchange service.',
                'price' => 1500,
                'icon' => 'repeat'
            ],
            [
                'title' => 'AC Installation & Uninstallation',
                'description' => 'Professional installation and uninstallation services for all types of AC units.',
                'price' => 1800,
                'icon' => 'tools'
            ],
            [
                'title' => 'VRF AC Service',
                'description' => 'Specialized services for Variable Refrigerant Flow (VRF) air conditioning systems.',
                'price' => 2500,
                'icon' => 'sliders'
            ],
            [
                'title' => 'AC Rental Service',
                'description' => 'Rent AC units for events, temporary needs, or before making a purchase decision.',
                'price' => 3000,
                'icon' => 'calendar'
            ]
        ];
        
        foreach ($additionalServices as $serviceData) {
            Service::create([
                'title' => $serviceData['title'],
                'slug' => Str::slug($serviceData['title']),
                'description' => $serviceData['description'],
                'price' => $serviceData['price'],
                'image' => 'images/services/service-placeholder.jpeg',
                'category_id' => $acCategory->id,
                'is_featured' => 0,
                'status' => 1,
                'icon' => $serviceData['icon']
            ]);
        }
        
        // Create Cleaning Solution category if it doesn't exist
        $cleaningCategory = ServiceCategory::where('slug', 'cleaning-solution')->first();
        
        if (!$cleaningCategory) {
            $cleaningCategory = ServiceCategory::create([
                'name' => 'Cleaning Solution',
                'slug' => 'cleaning-solution',
                'description' => 'Professional cleaning services for your home and office',
                'icon' => 'droplet',
                'status' => 1
            ]);
        }
        
        // Create cleaning services
        $cleaningServices = [
            [
                'title' => 'Home Cleaning',
                'description' => 'Complete home cleaning service including dusting, mopping, and bathroom cleaning.',
                'price' => 1500,
                'is_featured' => 1,
                'icon' => 'house'
            ],
            [
                'title' => 'Office Cleaning',
                'description' => 'Professional cleaning services for offices and commercial spaces.',
                'price' => 2500,
                'is_featured' => 1,
                'icon' => 'building'
            ],
            [
                'title' => 'Sofa Cleaning',
                'description' => 'Deep cleaning service for sofas and upholstery.',
                'price' => 1200,
                'is_featured' => 1,
                'icon' => 'droplet'
            ],
            [
                'title' => 'Carpet Cleaning',
                'description' => 'Professional carpet cleaning using advanced equipment and cleaning solutions.',
                'price' => 1800,
                'is_featured' => 0,
                'icon' => 'brush'
            ],
            [
                'title' => 'Kitchen Deep Cleaning',
                'description' => 'Thorough cleaning of kitchen including appliances, cabinets, and countertops.',
                'price' => 2000,
                'is_featured' => 0,
                'icon' => 'droplet'
            ],
            [
                'title' => 'Bathroom Deep Cleaning',
                'description' => 'Complete bathroom cleaning including tiles, fixtures, and sanitization.',
                'price' => 1500,
                'is_featured' => 0,
                'icon' => 'droplet'
            ]
        ];
        
        foreach ($cleaningServices as $serviceData) {
            Service::create([
                'title' => $serviceData['title'],
                'slug' => Str::slug($serviceData['title']),
                'description' => $serviceData['description'],
                'price' => $serviceData['price'],
                'image' => 'images/services/service-placeholder.jpeg',
                'category_id' => $cleaningCategory->id,
                'is_featured' => $serviceData['is_featured'],
                'status' => 1,
                'icon' => $serviceData['icon']
            ]);
        }
    }
    
    /**
     * Check if the required columns exist in the tables
     */
    private function checkRequiredColumns()
    {
        try {
            // Check service_categories table
            if (!Schema::hasColumn('service_categories', 'status')) {
                Schema::table('service_categories', function ($table) {
                    $table->boolean('status')->default(1)->after('icon');
                });
                $this->command->info('Added status column to service_categories table');
            }
            
            // Check services table
            if (!Schema::hasColumn('services', 'is_featured')) {
                Schema::table('services', function ($table) {
                    $table->boolean('is_featured')->default(0)->after('category_id');
                });
                $this->command->info('Added is_featured column to services table');
            }
            
            if (!Schema::hasColumn('services', 'status')) {
                Schema::table('services', function ($table) {
                    $table->boolean('status')->default(1)->after('is_featured');
                });
                $this->command->info('Added status column to services table');
            }
            
            if (!Schema::hasColumn('services', 'icon')) {
                Schema::table('services', function ($table) {
                    $table->string('icon')->nullable()->after('status');
                });
                $this->command->info('Added icon column to services table');
            }
            
            // Check if service_options table exists
            if (!Schema::hasTable('service_options')) {
                Schema::create('service_options', function ($table) {
                    $table->id();
                    $table->unsignedBigInteger('service_id');
                    $table->string('name');
                    $table->text('description')->nullable();
                    $table->decimal('price', 10, 2);
                    $table->decimal('original_price', 10, 2)->nullable();
                    $table->boolean('status')->default(1);
                    $table->timestamps();
                    
                    $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
                });
                $this->command->info('Created service_options table');
            }
        } catch (\Exception $e) {
            Log::error('Error checking required columns: ' . $e->getMessage());
            $this->command->error('Error checking required columns: ' . $e->getMessage());
        }
    }
}
