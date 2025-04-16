<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@servicehub.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '1234567890',
        ]);
        
        // Create service provider users
        $providers = [
            [
                'name' => 'John Doe',
                'email' => 'john@servicehub.com',
                'business_name' => 'John\'s Repair Services',
                'description' => 'Professional repair services with over 10 years of experience.',
                'phone' => '9876543210',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@servicehub.com',
                'business_name' => 'Jane\'s Beauty Salon',
                'description' => 'Premium beauty services for all your needs.',
                'phone' => '8765432109',
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@servicehub.com',
                'business_name' => 'Mike\'s Cleaning Co.',
                'description' => 'Professional cleaning services for homes and offices.',
                'phone' => '7654321098',
            ],
        ];
        
        foreach ($providers as $provider) {
            $user = User::create([
                'name' => $provider['name'],
                'email' => $provider['email'],
                'password' => Hash::make('password'),
                'role' => 'provider',
                'phone' => $provider['phone'],
            ]);
            
            ServiceProvider::create([
                'user_id' => $user->id,
                'business_name' => $provider['business_name'],
                'description' => $provider['description'],
                'phone_number' => $provider['phone'],
                'is_verified' => true,
                'rating' => rand(35, 50) / 10,
            ]);
        }
        
        // Create customer users
        $customers = [
            [
                'name' => 'Customer One',
                'email' => 'customer1@example.com',
                'phone' => '6543210987',
            ],
            [
                'name' => 'Customer Two',
                'email' => 'customer2@example.com',
                'phone' => '5432109876',
            ],
        ];
        
        foreach ($customers as $customer) {
            User::create([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => $customer['phone'],
            ]);
        }
    }
}