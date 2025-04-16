<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'AC Repair Services',
                'slug' => 'ac-repair-services',
                'description' => 'Professional AC repair and maintenance services',
                'icon' => 'fan',
                'status' => 1
            ],
            [
                'name' => 'Appliance Repair',
                'slug' => 'appliance-repair',
                'description' => 'Repair services for all home appliances',
                'icon' => 'tools',
                'status' => 1
            ],
            [
                'name' => 'Cleaning Solution',
                'slug' => 'cleaning-solution',
                'description' => 'Professional cleaning services for your home and office',
                'icon' => 'droplet',
                'status' => 1
            ],
            [
                'name' => 'Beauty & Wellness',
                'slug' => 'beauty-wellness',
                'description' => 'Beauty and wellness services at your doorstep',
                'icon' => 'heart',
                'status' => 1
            ],
            [
                'name' => 'Shifting',
                'slug' => 'shifting',
                'description' => 'Home and office shifting services',
                'icon' => 'truck',
                'status' => 1
            ],
            [
                'name' => 'Men\'s Care & Salon',
                'slug' => 'mens-care-salon',
                'description' => 'Grooming services for men',
                'icon' => 'scissors',
                'status' => 1
            ],
            [
                'name' => 'Health & Care',
                'slug' => 'health-care',
                'description' => 'Health and care services',
                'icon' => 'activity',
                'status' => 1
            ],
            [
                'name' => 'Electronics & Gadgets Repair',
                'slug' => 'electronics-gadgets-repair',
                'description' => 'Repair services for electronics and gadgets',
                'icon' => 'smartphone',
                'status' => 1
            ],
            [
                'name' => 'Electric & Plumbing',
                'slug' => 'electric-plumbing',
                'description' => 'Electrical and plumbing services',
                'icon' => 'zap',
                'status' => 1
            ],
            [
                'name' => 'Pest Control',
                'slug' => 'pest-control',
                'description' => 'Professional pest control services',
                'icon' => 'shield',
                'status' => 1
            ]
        ];

        foreach ($categories as $category) {
            ServiceCategory::create($category);
        }
    }
}
