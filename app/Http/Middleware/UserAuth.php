<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;


class UserAuth extends BaseAuthenticate
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Custom redirect logic
            return $request->expectsJson() ? null : route('auth-error');
        }
    }
}
