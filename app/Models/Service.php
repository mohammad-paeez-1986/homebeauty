<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'active',
        'price',
        'position'
    ];

    protected $casts = [
        'active' => 'boolean',
        'price' => 'integer',
        'position' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($service) {
            // If position is not set, make it the last position + 1
            if (is_null($service->position) || $service->position === 0) {
                $maxPosition = static::max('position') ?? 0;
                $service->position = $maxPosition + 1;
            }
        });
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
