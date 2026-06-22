<?php

namespace App\services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthService
{
    public static function registerOrLogin($mobile)
    {
        $user = User::where('mobile', $mobile)->first();

        if ($user) {
            // login if user exists
            Auth::login($user, true);
        } else {
            // register if not, then login
            $user = User::create([
                'mobile' => $mobile,
            ]);

            Auth::login($user, true);
        }

        return $user->id;
    }
}
