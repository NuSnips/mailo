<?php

namespace Database\Factories\Subscriber;

use Domain\Shared\Models\User;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
{

    protected $model = Subscriber::class;
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'email' => fake()->email(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'form_id' => Form::factory(),

        ];
    }
}
