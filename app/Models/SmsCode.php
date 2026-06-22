<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SmsCode extends Model
{
    // Disable updated_at
    const UPDATED_AT = null;

    protected $fillable = [
        'mobile',
        'code',
        'expires_at',
        'is_used',
        'used_at',
        'attempts',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
        'created_at' => 'datetime',
        'is_used' => 'boolean',
    ];



    // Generate a new code for user
    public static function generate($mobile): self
    {
        // Delete old codes for this user
        static::where('mobile', $mobile)
            ->where('is_used', false)
            ->delete();
        

        // Create new code
        return static::create([
            'mobile' => $mobile,
            'code' => rand(1000, 9999),
            'expires_at' => Carbon::now()->addMinutes(5),
            'is_used' => false,
        ]);
    }

    // Check if code is valid
    public function isValid(): bool
    {
        return !$this->is_used &&
            !$this->isExpired() &&
            $this->attempts <= 3;
    }

    // Check if code has expired
    public function isExpired(): bool
    {
        return Carbon::now()->gt($this->expires_at);
    }

    // Mark code as used
    public function markAsUsed(): void
    {
        $this->update([
            'is_used' => true,
            'used_at' => Carbon::now(),
        ]);
    }

    // Increment failed attempts
    public function incrementAttempts(): void
    {
        $this->increment('attempts');
    }

    // Get remaining seconds
    public function getRemainingSeconds(): int
    {
        if ($this->isExpired()) {
            return 0;
        }

        return Carbon::now()->diffInSeconds($this->expires_at, false);
    }

    // Get remaining minutes for display
    public function getRemainingTime(): string
    {
        $seconds = $this->getRemainingSeconds();
        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;

        return "{$minutes}:{$remainingSeconds}";
    }

    // check code
    public function checkCode($code): bool
    {
        return ($this->isValid() && $this->code === $code) ? true : false;
    }
}
