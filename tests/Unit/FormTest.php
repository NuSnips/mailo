<?php

use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;

it('has many subscribers', function () {
    $form = Form::factory()->create();

    $subscribers = Subscriber::factory()->count(3)->make()->toArray();
    // Create multiple subscribers for the form
    $form->subscribers()->createMany($subscribers);
    
    expect($form->subscribers)
        ->toHaveCount(3)
        ->contains($subscribers[0]);
});
