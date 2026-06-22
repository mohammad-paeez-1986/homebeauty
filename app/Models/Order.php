<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Morilog\Jalali\Jalalian;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'day',
        'time',
        'service_id',
        'description',
        'user_id',
        'status',
    ];

    protected $casts = [
        // 'time' => 'time',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function getDateTimeJalaliAttribute()
    {
        if (!$this->time) return null;

        try {
            return Jalalian::fromDateTime($this->time)->format('l d F Y ساعت: H:i');
        } catch (\InvalidArgumentException $e) {
            return $this->time->format('H:i');
        }
    }

    public function getJalalidayAttribute()
    {
        return Jalalian::fromFormat('Y-m-d', $this->day)->format('%d %B ، %Y H:i');
    }
}
