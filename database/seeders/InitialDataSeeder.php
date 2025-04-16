<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ServiceCategory;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        // Create service categories
        $categories = [
            ['name' => 'Cleaning', 'slug' => 'cleaning', 'icon' => 'brush'],
            ['name' => 'Plumbing', 'slug' => 'plumbing', 'icon' => 'water'],
            ['name' => 'Electrical', 'slug' => 'electrical', 'icon' => 'lightning'],
            ['name' => 'Painting', 'slug' => 'painting', 'icon' => 'palette'],
            ['name' => 'Carpentry', 'slug' => 'carpentry', 'icon' => 'hammer'],
            ['name' => 'Gardening', 'slug' => 'gardening', 'icon' => 'tree'],
            ['name' => 'Appliance Repair', 'slug' => 'appliance-repair', 'icon' => 'tools'],
            ['name' => 'Home Security', 'slug' => 'home-security', 'icon' => 'shield'],
        ];

        foreach ($categories as $category) {
            ServiceCategory::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'icon' => $category['icon'],
                'description' => 'This is a description for ' . $category['name'] . ' services.',
                'is_active' => true,
            ]);
        }

        // Create locations
        $locations = [
            [
                'name' => 'Dhaka',
                'slug' => 'dhaka',
                'city' => 'Dhaka',
                'state' => 'Dhaka',
                'country' => 'Bangladesh',
                'latitude' => 23.8103,
                'longitude' => 90.4125
            ],
            [
                'name' => 'Chittagong',
                'slug' => 'chittagong',
                'city' => 'Chittagong',
                'state' => 'Chittagong',
                'country' => 'Bangladesh',
                'latitude' => 22.3569,
                'longitude' => 91.7832
            ],
            [
                'name' => 'Sylhet',
                'slug' => 'sylhet',
                'city' => 'Sylhet',
                'state' => 'Sylhet',
                'country' => 'Bangladesh',
                'latitude' => 24.8949,
                'longitude' => 91.8687
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}