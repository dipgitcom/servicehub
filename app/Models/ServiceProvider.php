<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'location_id',
        'business_name',
        'description',
        'business_address',
        'business_phone',
        'business_email',
        'website',
        'profile_image',
        'rating',
        'rating_count',
        'is_verified',
        'is_featured',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'decimal:2',
        'rating_count' => 'integer',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the service provider.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the location of the service provider.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the services for the service provider.
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get the bookings for the service provider.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
