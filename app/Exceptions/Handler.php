<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;

class Handler
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // Check if the request expects JSON (common for API routes)
        return $request->expectsJson()
            ? response()->json(['message' => 'Unauthenticated.'], 401)
            : redirect()->guest(route('login'));
    }
}
