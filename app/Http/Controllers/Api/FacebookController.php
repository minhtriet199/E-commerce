<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\User_attribute;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FacebookController extends Controller
{

    protected $userController;
    public function __construct(UserController $userController){
        $this->userController = $userController;
    }

    public function loginfacebook()
    {
        return Socialite::driver('facebook')
        ->redirect();
    }

    public function loginCallback(Request $request)
    {
        $facebookUser = Socialite::driver('facebook')->stateless()->user();
        $findUser = User::where('email', $facebookUser->email)->first();
        
        if($findUser){
            Auth::login($findUser, true);
            return redirect(url('/'));
        }
        else{
            $user = User::updateOrCreate([
                'facebook_id' => $facebookUser->id,
            ], [
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'facebook_token' => $facebookUser->token,
                'facebook_refresh_token' => $facebookUser->refreshToken,
                'password'=> Hash::make(Str::random(11)),
            ]);
            User_attribute::create([
                'id' => $user->id,
                'user_id' => $user->id,
            ]);
        }
        
        Auth::login($user);

        return redirect('/');
        
    }
    
}
