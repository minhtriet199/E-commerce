<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('Laravel9PassportAuth')->accessToken;

        return response()->json(['success' => true], 200);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
            $user = User::where('email',$data['email'])->first();
            return response()->json(['success' => true,'user' => $user], 200);
        } else {
            return response()->json(['error' => true], 401);
        }
    }

    public function userInfo($id) 
    {
        $user = User::Where('id',$id)->first();
        return response()->json($user);
    }
    public function loginGoogle(){
        return Socialite::driver('google')
        ->redirect();
    }

    public function googleCallback(Request $request){
        $User = Socialite::driver('google')->stateless()->user();
        $findUser = User::where('email', $User->email)->first();
        if($findUser){
            Auth::login($findUser, true);
            if($findUser->email_verified_at == null){
                User::where('id',$findUser->id)
                ->update(['email_verified_at' => now(),]);
            }
            
            $this->cartServices->userStore();

            if(!session('link')){
                return redirect('/');
            }
             return redirect(session('link'));

        }
        else{
            $user = User::updateOrCreate([
                'google_id' => $User->id,
                'name' => $User->name,
                'email' => $User->email,
                'email_verified_at' => now(),
                'password'=> Hash::make(Str::random(11)),
            ]);
            User_attribute::create([
                'id' => $user->id,
                'user_id' => $user->id,
            ]);
        }
        Auth::login($user);
        // If user have cart session this will uploadd cart to database
        $this->cartServices->userStore();
        if(!session('link')){
            return redirect('/');
        }
        return redirect(session('link'));
    }
}



