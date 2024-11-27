<?php

use App\Http\Api\Controllers\Subscriber\SubscriberController as SubscriberSubscriberController;
use App\Http\Web\Controllers\ProfileController;
use App\Http\Web\Controllers\Subscriber\SubscriberController;
use Domain\Subscriber\DataTransferObjects\SubscriberDTO;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", [SubscriberController::class, 'index']);
Route::post("/subscribe", [SubscriberController::class, 'store']);


// Route::post("/api/subscribe", [SubscriberSubscriberController::class, 'store'])->middleware(['token.auth'])->name('api.subscribe.store');
// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
