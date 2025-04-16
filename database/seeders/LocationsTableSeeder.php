<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            ['name' => 'Dhaka', 'type' => 'city', 'is_active' => true],
            ['name' => 'Chittagong', 'type' => 'city', 'is_active' => true],
            ['name' => 'Sylhet', 'type' => 'city', 'is_active' => true],
            ['name' => 'Rajshahi', 'type' => 'city', 'is_active' => true],
            ['name' => 'Khulna', 'type' => 'city', 'is_active' => true],
            ['name' => 'Barisal', 'type' => 'city', 'is_active' => true],
            ['name' => 'Rangpur', 'type' => 'city', 'is_active' => true],
            ['name' => 'Mymensingh', 'type' => 'city', 'is_active' => true],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}