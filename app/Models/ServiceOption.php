<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'name',
        'description',
        'price',
        'original_price',
        'status',
    ];

    /**
     * Get the service that owns the option.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
