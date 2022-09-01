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
