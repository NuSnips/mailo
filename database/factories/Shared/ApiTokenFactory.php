<?php

namespace Database\Factories;

use Carbon\Carbon;
use Domain\Shared\Models\ApiToken;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 */
class ApiTokenFactory extends Factory
{

    protected $model = ApiToken::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'token' => hash('sha256', Str::random(60)),
            'expires_at' => Carbon::now()->addYear()
        ];
    }
}
