<?php

use App\Http\Api\Controllers\Subscriber\SubscriberController;
use Domain\Subscriber\DataTransferObjects\SubscriberDTO;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name("api.")->middleware(['token.auth'])->group(function () {
    Route::post("/subscribe", [SubscriberController::class, 'store'])->name("subscribe");
});
Route::post("/users", function (SubscriberDTO $subscriberDTO, Request $request) {
    $subscriber = Subscriber::updateOrCreate([
        'id' => $subscriberDTO->id
    ], [
        ...$subscriberDTO->toArray(),
        'form_id' => $subscriberDTO->form?->id,
        'user_id' => $request->user()?->id
    ]);
    $subscriber->tags()->sync($subscriberDTO->tags->pluck('id'));
    return response()->json($subscriber->load('tags', 'form'));
})->middleware(['token.auth']);
