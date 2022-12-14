<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\Password\PasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\User\UserInfomationRequest;
use App\Http\Requests\loginRequest;
use App\Http\Services\User\UserService;
use App\Http\Services\Order\OrderService;
use App\Http\Services\Voucher\VoucherService;
use App\Http\Services\CartServices;
use App\Models\User;
use App\Models\User_attribute;
use App\Models\Cities;
use App\Models\District;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Password_reset;
use App\Jobs\sendNotification;
use Carbon\Carbon;

use App\Notifications\ResetPassword;



class UserController extends Controller
{

    protected $userServices;
    protected $cartServices;

    public function __construct(UserService $userServices,OrderService $orderService,VoucherService $voucherService,CartServices $cartServices){
        $this ->userServices = $userServices;
        $this ->orderService = $orderService;
        $this ->voucherService = $voucherService;
        $this ->cartServices = $cartServices;
    }

    public function index(){
        $user = $this->userServices->get();
        $id = $user['id'];
        return view('user.account.profile',
        [
            'title'=> 'Tài khoản',
            'account' => $user,
            'cities' => $city = Cities::all(),
            'orders' => $this->orderService->get(),
            'districts' => $this->userServices->user_district($id),
            'vouchers' => $this->voucherService->get(),
        ]);
    }

    public function signup(){
        return view('user.signup',[
            'title' => 'Đăng ký'
        ]);
    }

    public function create(UserRequest $request){
        $result = $this->userServices->insert($request);
        if($result) return redirect('/user/login')->withInput();
        else return redirect()->back()->withInput();
    }

    public function login(){
        // This will save previous page for after login and redirect back to the page
        if( url()->previous() == 'http://127.0.0.1:8000/user/signup')  session::forget('link');
        else session(['link' => url()->previous()]);
        return view('user.login',[
            'title' => 'Đăng nhập'
        ]);
    }
    //facebook
    public function loginfacebook(){
        return Socialite::driver('facebook')
        ->redirect();
    }

    public function facebookCallback(Request $request){
        $User = Socialite::driver('facebook')->stateless()->user();
        $findUser = User::where('email', $User->email)->first();
        
        if($findUser){
            Auth::login($findUser, true);
            $this->cartServices->userStore();

            if(!session('link')){
                return redirect('/');
            }
             return redirect()->intended(session('link'));
        }
        else{
            $user = User::updateOrCreate([
                'facebook_id' => $User->id,
                'name' => $User->name,
                'email' => $User->email,
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
    //end facebook
    //google login
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
    //end google

    
    public function store(loginRequest $request){
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input( 'password'),
        ])){
            // If user have cart session this will upload cart to database
            $this->cartServices->userStore();
            return redirect(session('link'));
        }
        Session()->flash( 'error','Email hoặc password không đúng');
        return redirect()->back();
    }

    // Quên mật khẩu
    public function reset(){
        return view('user.reset',[
            'title' => 'Quên mật khẩu'
        ]);
    }

    public function sendResetLink(ResetPasswordRequest $request){
        if(Auth::check()){
            if($request->email != Auth::user()->email){
                Session()->flash( 'error','Email không đúng');
                return redirect()->back();
            }
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $password = Password_reset::updateOrCreate([
            'email' => $user->email,
            'token' => Str::random(60),
        ]);
        if($password){
            // This will putting sending Notification to queue
            // More in App\Jobs\sendNotification
            // Use php artisan schedule:work in terminal for it to work
           dispatch(new sendNotification($user,$password));
        }Session()->flash( 'success','Hãy kiểm tra email của bạn');
        return redirect()->back();

    }

    //Đổi pass 
    public function passwordForm($token){
        return view('user.change_password',[
            'title' => 'Tạo mật khẩu mới',
        ])->with(['token'=>$token]);
    }

    public function change_pass(PasswordRequest $request){
        $data = $request->all();
        $passwordReset = Password_reset::where('token',$data['token'])->first();
        if($passwordReset){
            $user = User::where('email',$passwordReset->email)->first();
            $user->update(['password' => Hash::make($data['password']) ]);
            $passwordReset->delete();
            Session()->flash( 'success','Đổi mật khẩu thành công');
            if(Auth::check()) $this->logouts();
             Session::forget('link');
            return redirect('user/login')->withInput();
        }
        else{
            Session()->flash('error','Bị lỗi');
            return redirect('user/reset');
        }
    }

    public function logouts(){   
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    // Using ajax to update user profile 
    // More in Assets/js/main.js and find btn-update-order
    public function update(UserInfomationRequest $request){
        $data = $request->all();
        $User_attribute = User_attribute::find(Auth::id());
        $User_attribute->update([
            'name' => $data['user_name'],
            'address' => $data['address'],
            'city' => $data['city'],
            'district' => $data['district'],
            'phone' => $data['phone'],
        ]);
        $User = User::where('id',Auth::id())->update(['name' => $data['user_name'],]);
        return response()->json([
            'error' == true
        ]);
    }

}


