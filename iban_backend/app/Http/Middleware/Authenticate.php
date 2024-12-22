<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        
        try {
            // Try to authenticate using JWT
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            // Token is either missing, invalid, or expired
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        return $next($request);
    }
}
