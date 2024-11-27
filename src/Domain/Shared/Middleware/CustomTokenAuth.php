<?php

namespace Domain\Shared\Middleware;

use Closure;
use Domain\Shared\Models\ApiToken;
use Exception;
use Illuminate\Http\Request;

class CustomTokenAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        try {
            $apiToken = $this->getApiToken($token);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        // Update last used
        $apiToken->update(['last_used_at' => now()]);
        // Set authenticated user
        $request->setUserResolver(fn() => $apiToken->user);

        return $next($request);
    }

    protected function getApiToken(string $token): ApiToken
    {
        $hashed = hash('sha256', $token);
        $apiToken = ApiToken::where('token', $hashed)->first();
        if (!$apiToken) throw new Exception("Invalid token.");
        if ($apiToken->isExpired()) throw new Exception("Token expired.");

        return $apiToken;
    }
}
