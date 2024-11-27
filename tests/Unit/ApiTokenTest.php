<?php

use Carbon\Carbon;
use Domain\Shared\Models\ApiToken;
use Domain\Shared\Models\User;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->user = User::factory()->create([
        'email' => 'jame.smith@email.com'
    ]);
    $this->apiToken = new ApiToken([
        'name' => 'Api token',
        'token' => hash('sha256', Str::random(60)),
        'expires_at' => Carbon::now()->addDays(30)
    ]);
});

it('belongs to a user', function () {
    $apiToken = new ApiToken([
        'name' => 'Api token',
        'token' => hash('sha256', Str::random(60)),
        'expires_at' => Carbon::now()->addDays(30)
    ]);
    $apiToken->user()->associate($this->user);
    $apiToken->save();
    $apiToken->load('user');

    expect($apiToken->user)->toBeInstanceOf(User::class)
        ->and($apiToken->user->email)->toBe('jame.smith@email.com');
});

it('return false when expire date is past the current date.', function () {
    $apiToken = new ApiToken([
        'name' => 'API Token 1',
        'token' => hash('sha256', Str::random(60)),
        'expires_at' => Carbon::now()->addDays(30)
    ]);
    $this->user->apiTokens()->save($apiToken);
    // Load the relationship
    $this->user->load('apiTokens');
    // Update the token to have a passed date
    $this->user->apiTokens->get(0)->update([
        'expires_at' => Carbon::now()->subDays(30)
    ]);

    expect($this->user->apiTokens->get(0)->isExpired())->toBeTrue();
});
