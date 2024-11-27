<?php

use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;

it("belongs to many subscribers", function () {
    $tag = Tag::factory()->create();
    $subscribers = Subscriber::factory()->count(4)->make();

    // Attach subscribers to the tag
    $tag->subscribers()->saveMany($subscribers);
    
    expect($tag->subscribers)
        ->toHaveCount(4)
        ->contains($subscribers->first());
});
