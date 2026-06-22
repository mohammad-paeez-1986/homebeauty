<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';
    
    protected $fillable = [
        'mobile',
        'google2fa_secret',
        'is_active',
    ];

    protected $hidden = [
        'remember_token',
        // 'google2fa_secret',
    ];

    protected function casts(): array
    {
        return [
            'mobile_verified_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
    
    // Set Google2FA secret
    public function setGoogle2faSecretAttribute($value)
    {
        $this->attributes['google2fa_secret'] = encrypt($value);
    }
    
    // Get Google2FA secret
    public function getGoogle2faSecretAttribute($value)
    {
        return decrypt($value);
    }
}