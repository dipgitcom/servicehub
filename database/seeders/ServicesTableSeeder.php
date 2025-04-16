<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        $acCategory = ServiceCategory::where('name', 'AC Repair')->first();
        $applianceCategory = ServiceCategory::where('name', 'Appliance Repair')->first();
        $beautyCategory = ServiceCategory::where('name', 'Beauty & Salon')->first();
        $cleaningCategory = ServiceCategory::where('name', 'Cleaning')->first();
        
        // AC Services
        $acServices = [
            [
                'name' => 'AC Servicing',
                'description' => 'Professional AC servicing to keep your air conditioner running efficiently.',
                'price' => 1500,
                'image' => 'services/ac-servicing.jpg',
            ],
            [
                'name' => 'AC Installation',
                'description' => 'Expert installation of all types of air conditioners.',
                'price' => 2500,
                'image' => 'services/ac-installation.jpg',
            ],
            [
                'name' => 'AC Gas Refill',
                'description' => 'AC gas refill service by certified technicians.',
                'price' => 1800,
                'image' => 'services/ac-gas-refill.jpg',
            ],
        ];
        
        foreach ($acServices as $service) {
            Service::create([
                'category_id' => $acCategory->id,
                'name' => $service['name'],
                'slug' => Str::slug($service['name']),
                'description' => $service['description'],
                'price' => $service['price'],
                'image' => $service['image'],
                'is_active' => true,
            ]);
        }
        
        // Appliance Services
        $applianceServices = [
            [
                'name' => 'Refrigerator Repair',
                'description' => 'Expert repair service for all types of refrigerators.',
                'price' => 1200,
                'image' => 'services/refrigerator-repair.jpg',
            ],
            [
                'name' => 'Washing Machine Repair',
                'description' => 'Professional repair service for washing machines of all brands.',
                'price' => 1300,
                'image' => 'services/washing-machine-repair.jpg',
            ],
            [
                'name' => 'Microwave Oven Repair',
                'description' => 'Quick and reliable microwave oven repair service.',
                'price' => 800,
                'image' => 'services/microwave-repair.jpg',
            ],
        ];
        
        foreach ($applianceServices as $service) {
            Service::create([
                'category_id' => $applianceCategory->id,
                'name' => $service['name'],
                'slug' => Str::slug($service['name']),
                'description' => $service['description'],
                'price' => $service['price'],
                'image' => $service['image'],
                'is_active' => true,
            ]);
        }
        
        // Beauty Services
        $beautyServices = [
            [
                'name' => 'Haircut & Style',
                'description' => 'Professional haircut and styling by expert stylists.',
                'price' => 500,
                'image' => 'services/haircut.jpg',
            ],
            [
                'name' => 'Facial Treatment',
                'description' => 'Rejuvenating facial treatments for glowing skin.',
                'price' => 1500,
                'image' => 'services/facial.jpg',
            ],
            [
                'name' => 'Manicure & Pedicure',
                'description' => 'Complete nail care service for hands and feet.',
                'price' => 1200,
                'image' => 'services/manicure.jpg',
            ],
        ];
        
        foreach ($beautyServices as $service) {
            Service::create([
                'category_id' => $beautyCategory->id,
                'name' => $service['name'],
                'slug' => Str::slug($service['name']),
                'description' => $service['description'],
                'price' => $service['price'],
                'image' => $service['image'],
                'is_active' => true,
            ]);
        }
        
        // Cleaning Services
        $cleaningServices = [
            [
                'name' => 'Home Deep Cleaning',
                'description' => 'Comprehensive cleaning service for your entire home.',
                'price' => 3000,
                'image' => 'services/home-cleaning.jpg',
            ],
            [
                'name' => 'Sofa Cleaning',
                'description' => 'Professional sofa cleaning service to remove stains and dirt.',
                'price' => 1500,
                'image' => 'services/sofa-cleaning.jpg',
            ],
            [
                'name' => 'Carpet Cleaning',
                'description' => 'Deep carpet cleaning to remove dust, stains, and allergens.',
                'price' => 1800,
                'image' => 'services/carpet-cleaning.jpg',
            ],
        ];
        
        foreach ($cleaningServices as $service) {
            Service::create([
                'category_id' => $cleaningCategory->id,
                'name' => $service['name'],
                'slug' => Str::slug($service['name']),
                'description' => $service['description'],
                'price' => $service['price'],
                'image' => $service['image'],
                'is_active' => true,
            ]);
        }
    }
}