<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AddMoreCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:add-more';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add more service categories to the ServiceHub platform';

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
        $this->info('Adding more service categories...');
        
        // Run the seeder
        Artisan::call('db:seed', ['--class' => 'AdditionalCategoriesSeeder']);
        
        $this->info('Additional service categories have been added successfully!');
        
        return 0;
    }
}
