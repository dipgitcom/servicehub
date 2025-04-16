<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrations:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix migration issues by marking problematic migrations as completed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if the migration already exists in the migrations table
        $exists = DB::table('migrations')
            ->where('migration', '2025_04_11_064716_create_bookings_table')
            ->exists();

        if (!$exists) {
            // Insert the migration record to mark it as completed
            DB::table('migrations')->insert([
                'migration' => '2025_04_11_064716_create_bookings_table',
                'batch' => DB::table('migrations')->max('batch') ?: 1,
            ]);
            
            $this->info('Migration 2025_04_11_064716_create_bookings_table marked as completed.');
        } else {
            $this->info('Migration 2025_04_11_064716_create_bookings_table is already marked as completed.');
        }

        $this->info('Migration fix completed. You can now run your other migrations.');
    }
}
