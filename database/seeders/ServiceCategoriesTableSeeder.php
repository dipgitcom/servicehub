<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

class ServiceCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'AC Repair', 'icon' => 'categories/ac-repair.png'],
            ['name' => 'Appliance Repair', 'icon' => 'categories/appliance-repair.png'],
            ['name' => 'Beauty & Salon', 'icon' => 'categories/beauty-salon.png'],
            ['name' => 'Cleaning', 'icon' => 'categories/cleaning.png'],
            ['name' => 'Electrical', 'icon' => 'categories/electrical.png'],
            ['name' => 'Plumbing', 'icon' => 'categories/plumbing.png'],
            ['name' => 'Painting', 'icon' => 'categories/painting.png'],
            ['name' => 'Shifting', 'icon' => 'categories/shifting.png'],
            ['name' => 'Car Care', 'icon' => 'categories/car-care.png'],
            ['name' => 'Electronics', 'icon' => 'categories/electronics.png'],
        ];

        foreach ($categories as $category) {
            ServiceCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'icon' => $category['icon'],
                'description' => 'Professional ' . $category['name'] . ' services for your home and office.',
                'is_active' => true,
            ]);
        }
    }
}