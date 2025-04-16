<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceOption;
use App\Models\ServiceCategory;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get AC Repair Services category
        $acCategory = ServiceCategory::where('slug', 'ac-repair-services')->first();
        
        if ($acCategory) {
            // AC Doctor Service
            $acDoctor = Service::create([
                'title' => 'AC Doctor',
                'slug' => 'ac-doctor',
                'description' => 'AC Doctor involves evaluating the energy usage of your air conditioning system to identify any inefficiencies and recommend measures to improve energy efficiency. This service helps optimize your AC\'s performance while reducing energy costs.',
                'price' => 449,
                'image' => 'services/ac-doctor.jpg',
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
                'image' => 'services/ac-servicing.jpg',
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
                'image' => 'services/ac-combo.jpg',
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
            $services = [
                [
                    'title' => 'AC Cooling Problem',
                    'slug' => 'ac-cooling-problem',
                    'description' => 'Diagnostic and repair services for AC units that are not cooling properly.',
                    'price' => 800,
                    'icon' => 'thermometer-snow'
                ],
                [
                    'title' => 'AC Exchange',
                    'slug' => 'ac-exchange',
                    'description' => 'Exchange your old AC for a new one with our convenient exchange service.',
                    'price' => 1500,
                    'icon' => 'repeat'
                ],
                [
                    'title' => 'AC Installation & Uninstallation',
                    'slug' => 'ac-installation-uninstallation',
                    'description' => 'Professional installation and uninstallation services for all types of AC units.',
                    'price' => 1800,
                    'icon' => 'tool'
                ],
                [
                    'title' => 'VRF AC Service',
                    'slug' => 'vrf-ac-service',
                    'description' => 'Specialized services for Variable Refrigerant Flow (VRF) air conditioning systems.',
                    'price' => 2500,
                    'icon' => 'settings'
                ],
                [
                    'title' => 'AC Rental Service',
                    'slug' => 'ac-rental-service',
                    'description' => 'Rent AC units for events, temporary needs, or before making a purchase decision.',
                    'price' => 3000,
                    'icon' => 'calendar'
                ]
            ];
            
            foreach ($services as $serviceData) {
                Service::create([
                    'title' => $serviceData['title'],
                    'slug' => $serviceData['slug'],
                    'description' => $serviceData['description'],
                    'price' => $serviceData['price'],
                    'image' => 'services/service-placeholder.jpg',
                    'category_id' => $acCategory->id,
                    'is_featured' => 0,
                    'status' => 1,
                    'icon' => $serviceData['icon']
                ]);
            }
        }
        
        // Add services for other categories as well
        $categories = ServiceCategory::where('slug', '!=', 'ac-repair-services')->get();
        
        foreach ($categories as $category) {
            // Create sample services for each category
            for ($i = 1; $i <= 3; $i++) {
                $service = Service::create([
                    'title' => $category->name . ' ' . $i,
                    'slug' => strtolower(str_replace(' ', '-', $category->name)) . '-' . $i,
                    'description' => 'This is a sample service for ' . $category->name,
                    'price' => rand(500, 3000),
                    'image' => 'services/service-placeholder.jpg',
                    'category_id' => $category->id,
                    'is_featured' => $i == 1 ? 1 : 0,
                    'status' => 1,
                    'icon' => $category->icon
                ]);
                
                // Create sample options for each service
                ServiceOption::create([
                    'service_id' => $service->id,
                    'name' => 'Basic Option',
                    'description' => 'Basic service option',
                    'price' => $service->price,
                    'original_price' => $service->price + 200,
                    'status' => 1
                ]);
                
                ServiceOption::create([
                    'service_id' => $service->id,
                    'name' => 'Premium Option',
                    'description' => 'Premium service option with additional features',
                    'price' => $service->price + 500,
                    'original_price' => $service->price + 800,
                    'status' => 1
                ]);
            }
        }
    }
}
