<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function loginGoogle()
    {
        return Socialite::driver('google')
        ->with(
            ['client_id' => '821766446579-ssdtda0pq4lq5te1fo9h6ekt2p45ng19.apps.googleusercontent.com'],
            ['client_secret' => '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'],
            ['redirect' => 'http://localhost:8000/login/google/callback'])
        ->redirect();
    }

    public function loginCallback(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $findUser = User::where('email', $googleUser->email)->first();
        
        if($findUser){
            Auth::login($findUser);
            return redirect('/');
        }
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
            'password'=> '123',
        ]);
     
        Auth::login($user);
     
        return redirect('/');
        
    }
}
