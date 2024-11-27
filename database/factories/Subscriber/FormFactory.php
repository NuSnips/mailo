<?php

namespace Database\Factories\Subscriber;

use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormFactory extends Factory
{

    protected $model = Form::class;
    public function definition()
    {
        return [
            'title' => fake()->word(),
            'content' => fake()->randomHtml()
        ];
    }
}
