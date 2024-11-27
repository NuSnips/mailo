<?php

use Carbon\Carbon;
use Domain\Shared\Models\ApiToken;
use Domain\Shared\Models\User;
use Illuminate\Support\Str;

it('has many api tokens', function () {
    $user = User::factory()->create([
        'email' => 'jane.doe@email.com'
    ]);

    $apiTokens = [
        new ApiToken([
            'name' => 'Api token 1',
            'token' => hash('sha256', Str::random(60)),
            'expires_at' => Carbon::now()->addDays(30)
        ]),
        new ApiToken([
            'name' => 'Api token 2',
            'token' => hash('sha256', Str::random(60)),
            'expires_at' => Carbon::now()->addDays(30)
        ])
    ];
    $user->apiTokens()->saveMany($apiTokens);
    $user->load('apiTokens');
    expect($user->apiTokens)
        ->toHaveCount(count: 2)
        ->and($user->apiTokens->first())
        ->name->toBe('Api token 1')
        ->and($user->apiTokens->last())
        ->name->toBe('Api token 2');
});

it('can create a token', function () {
    $user = User::factory()->create(['email' => 'sam.winchester@email.com']);
    $apiToken = $user->createToken("API token 1");

    expect($apiToken)
        ->toBeInstanceOf(ApiToken::class)
        ->and($apiToken->name)->toBe('API token 1')
        ->and($apiToken->token)->toBe(hash('sha256', $apiToken->plainTextToken));
});
