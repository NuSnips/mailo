<?php

namespace Database\Factories\Subscriber;

use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{

    protected $model = Tag::class;
    public function definition()
    {
        return [
            'title' => fake()->word()
        ];
    }
}
