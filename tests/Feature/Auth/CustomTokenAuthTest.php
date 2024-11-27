<?php

use Carbon\Carbon;
use Domain\Shared\Models\ApiToken;
use Domain\Shared\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

beforeEach(function () {
    Route::middleware(['token.auth'])->group(function () {
        Route::get('/test-route', function () {
            return response()->json(['message' => 'success', 'status' => true]);
        });
    });
    $this->user = User::factory()->create([
        'email' => 'jane@email.com'
    ]);
    $this->apiToken = $this->user->createToken('Test Token')->plainTextToken;
});
it('should block unauthenticated requests to protected routes', function () {
    // Call the protected route
    $response = $this->getJson('/test-route');

    // Assert that the response has a 401 status code
    $response->assertStatus(401);
    $response->assertJson(['error' => 'Unauthenticated.']);
});

it('should block  requests to protected routes with invalid token', function () {

    // Generate invalid token
    $invalidToken = hash('sha256', Str::random(60));

    // Call the protected route with invalid token
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $invalidToken
    ])->get('/test-route');

    // Assert that the response has a 401 status code
    $response->assertStatus(401);
    expect($response->json('error'))->toBe('Invalid token.');
});

it('should allow access to protected route with valid token', function () {

    $response = $this->withHeaders(['Authorization' => "Bearer {$this->apiToken}"])
        ->getJson("/test-route");

    $response->assertStatus(200);
    $response->assertJson(['message' => 'success', 'status' => true]);
});

it('should block requests to protected route with expired token', function () {
    $this->user->apiTokens()->first()->update([
        'expires_at' => Carbon::now()->subDay()
    ]);
    $response = $this->withHeaders(['Authorization' => "Bearer {$this->apiToken}"])
        ->getJson("/test-route");

    $response->assertStatus(401);
    $response->assertJson(['error' => 'Token expired.']);
});
