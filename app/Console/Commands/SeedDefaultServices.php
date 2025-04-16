<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedDefaultServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'services:seed-default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed default services data for the ServiceHub platform';

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
        $this->info('Seeding default services data...');
        
        // Run the seeder
        Artisan::call('db:seed', ['--class' => 'DefaultServicesSeeder']);
        
        $this->info('Default services data has been seeded successfully!');
        
        return 0;
    }
}
