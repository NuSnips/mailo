<?php

namespace App\Http\Web\Controllers\Subscriber;

use App\Http\Web\Controllers\Controller;
use Domain\Subscriber\DataTransferObjects\SubscriberDTO;
use Domain\Subscriber\Models\Form;
use Domain\Subscriber\Models\Subscriber;
use Domain\Subscriber\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class SubscriberController extends Controller
{

    public function index()
    {

        // $credentials = [
        //     'email' => 'jane.smith@email.com',
        //     'password' => 'password'
        // ];
        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user();
        //     $token = $user->createToken('API Token');
        //     $plainTextToken = $token->plainTextToken;
        //     return $plainTextToken;
        //     // $token = $user->createToken('API Token', ['users:read', 'users:write']);
        //     // $tokenString = $token->plainTextToken;
        //     // dd(vars: $token->accessToken);
        // }

        return Inertia::render('Subscribe', [
            'tags' => Tag::query()->select('id', 'title')->orderBy('id')->get(),
            'forms' => Form::query()->select('id', 'title')->get()
        ]);
    }
    public function store(SubscriberDTO $subscriberData, Request $request)
    {
        dd($request->input());
        $response = Http::withToken(env('VITE_APP_API_KEY'))
            ->post(url('/api/users'), $request->all());
        dd($response->body());
    }
}
