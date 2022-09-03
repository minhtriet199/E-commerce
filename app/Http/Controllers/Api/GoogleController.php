<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            Auth::login($findUser, true);
            return redirect(url('/'));
        }
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
            'password'=> Hash::make('dungcodocchidaudau'),
        ]);
     
        Auth::login($user, true);
     
        return redirect('/');
        
    }
}
