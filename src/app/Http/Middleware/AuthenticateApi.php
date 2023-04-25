<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateApi
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $accessToken = \App\Models\PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->merge(['user' => $accessToken->tokenable]);

        return $next($request);
    }
}
