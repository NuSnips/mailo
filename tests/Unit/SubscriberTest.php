<?php

namespace Tests\Unit\Domain\Subscriber\Models;

use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;

mutates(Subscriber::class);

it('belongs to many tags', function () {
    $subscriber = Subscriber::factory()->create();
    $tags = Tag::factory(3)->create();
    $subscriber->tags()->attach($tags);
    expect($subscriber->tags)->toHaveCount(3)
        ->contains($tags[1]);
});

it('belongs to a form', function () {
    $subscriber = Subscriber::factory()->create();
    $form = Form::factory()->create();
    $subscriber->form()->associate($form);
    expect($subscriber->form)->toBe($form);
});
