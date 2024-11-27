<?php

namespace Database\Seeders;

use Domain\Shared\Models\User;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        // Create forms
        $forms = Form::factory()->count(3)->sequence(
            ['title' => 'Form 1'],
            ['title' => 'Form 2'],
            ['title' => 'Form 3'],
        )->create();

        // Create tags
        $tags = Tag::factory()->count(10)->sequence(
            ['title' => 'Tag 1'],
            ['title' => 'Tag 2'],
            ['title' => 'Tag 3'],
            ['title' => 'Tag 4'],
            ['title' => 'Tag 5'],
            ['title' => 'Tag 6'],
            ['title' => 'Tag 7'],
            ['title' => 'Tag 8'],
            ['title' => 'Tag 9'],
            ['title' => 'Tag 10'],
        )->create();
        // Create subscribers
        $subscribers = Subscriber::factory()->count(10)->sequence(
            [
                'user_id' => $user->id,
                'email' => 'subscriber1@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
            [
                'user_id' => $user->id,
                'email' => 'subscriber2@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
            [
                'user_id' => $user->id,
                'email' => 'subscriber3@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
            [
                'user_id' => $user->id,
                'email' => 'subscriber4@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
            [
                'user_id' => $user->id,
                'email' => 'subscriber5@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
            [
                'user_id' => $user->id,
                'email' => 'subscriber6@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
            [
                'user_id' => $user->id,
                'email' => 'subscriber7@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
            [
                'user_id' => $user->id,
                'email' => 'subscriber8@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
            [
                'user_id' => $user->id,
                'email' => 'subscriber9@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
            [
                'user_id' => $user->id,
                'email' => 'subscriber10@example.com',
                'form_id' => Form::inRandomOrder()->first(),
            ],
        )->create();

        //Attach tags to subscribers
        foreach ($subscribers as $subscriber) {
            $subscriber->tags()->attach(Tag::inRandomOrder()->limit(rand(1, 4))->pluck('id'));
        }
    }
}
