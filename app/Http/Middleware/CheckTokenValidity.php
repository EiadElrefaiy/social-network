<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class CheckTokenValidity
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $user->currentAccessToken();

        if (!$token) {
            return response()->json(['message' => 'Token not found'], 401);
        }

        // Check if token is not expired
        if ($token->expires_at && $token->expires_at->isPast()) {
            return response()->json(['message' => 'Token expired'], 401);
        }

        return $next($request);
    }
}
