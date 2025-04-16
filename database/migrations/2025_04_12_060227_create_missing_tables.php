<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add missing columns to users table
        if (Schema::hasTable('users') && !Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('user')->after('email'); // user, provider, admin
                $table->string('phone')->nullable()->after('role');
                $table->string('address')->nullable()->after('phone');
                $table->string('profile_image')->nullable()->after('address');
            });
        }

        // Create locations table if it doesn't exist
        if (!Schema::hasTable('locations')) {
            Schema::create('locations', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('country')->nullable();
                $table->decimal('latitude', 10, 7)->nullable();
                $table->decimal('longitude', 10, 7)->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Create service_providers table if it doesn't exist
        if (!Schema::hasTable('service_providers')) {
            Schema::create('service_providers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('location_id')->nullable()->constrained()->onDelete('set null');
                $table->string('business_name');
                $table->text('description')->nullable();
                $table->string('business_address')->nullable();
                $table->string('business_phone')->nullable();
                $table->string('business_email')->nullable();
                $table->string('website')->nullable();
                $table->string('profile_image')->nullable();
                $table->decimal('rating', 3, 2)->default(0.00);
                $table->integer('rating_count')->default(0);
                $table->boolean('is_verified')->default(false);
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Create services table if it doesn't exist
        if (!Schema::hasTable('services')) {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->foreignId('service_provider_id')->constrained()->onDelete('cascade');
                $table->foreignId('category_id')->constrained('service_categories')->onDelete('cascade');
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description');
                $table->decimal('price', 10, 2);
                $table->string('duration')->nullable();
                $table->string('image')->nullable();
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Create reviews table if it doesn't exist
        if (!Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('service_id')->constrained()->onDelete('cascade');
                $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');
                $table->integer('rating');
                $table->text('comment')->nullable();
                $table->boolean('is_approved')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't want to drop tables in the down method
        // as it might cause data loss
    }
};
