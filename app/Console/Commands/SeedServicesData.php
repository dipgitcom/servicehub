<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedServicesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'services:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the services data for the ServiceHub platform';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Seeding services data...');
        
        // Run the seeders
        Artisan::call('db:seed', ['--class' => 'ServiceCategorySeeder']);
        $this->info('Service categories seeded successfully.');
        
        Artisan::call('db:seed', ['--class' => 'ServiceSeeder']);
        $this->info('Services seeded successfully.');
        
        $this->info('All services data has been seeded successfully!');
        
        return 0;
    }
}
