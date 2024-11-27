<?php

namespace App\Http\Api\Controllers\Subscriber;

use App\Http\Api\Controllers\Controller;
use Domain\Subscriber\DataTransferObjects\SubscriberDTO;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{

    public function store(SubscriberDTO $subscriberData, Request $request)
    {
        $subscriber = Subscriber::updateOrCreate(
            [
                'id' => $subscriberData->id,
            ],
            [
                ...$subscriberData->toArray(),
                'form_id' => $subscriberData->form?->id,
                'user_id' => request()->user()?->id
            ]
        );
        $subscriber->tags()->sync($subscriberData->tags->pluck('id'));
        return response()->json($subscriber->load('tags', 'form'));
    }
}
