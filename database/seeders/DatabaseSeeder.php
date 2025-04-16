<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LocationsTableSeeder::class,
            ServiceCategoriesTableSeeder::class,
            UsersTableSeeder::class,
            ServicesTableSeeder::class,
            ServiceSeeder::class
            ServiceCategorySeeder::class,
            AdditionalCategoriesSeeder::class,
        ]);
    }
}