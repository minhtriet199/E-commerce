<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Http\Services\User\UserService;
use App\Http\Services\Order\OrderService;
use App\Http\Services\Voucher\VoucherService;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\User_attribute;
use App\Models\Cities;
use App\Models\District;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Password_reset;
use Carbon\Carbon;
Use Alert;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\Password\PasswordRequest;
use App\Notifications\ResetPassword;



class UserController extends Controller
{

    protected $userServices;

    public function __construct(UserService $userServices,OrderService $orderService,VoucherService $voucherService){
        $this ->userServices = $userServices;
        $this ->orderService =$orderService;
        $this ->voucherService = $voucherService;
    }

    public function index(){
        $city = Cities::all();
        return view('user.account.profile',
        [
            'title'=> 'Tài khoản',
            'users' => $this->userServices->get(),
            'citys' => $city,
            'orders' => $this->orderService->get(),
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
        $facebookUser = Socialite::driver('facebook')->stateless()->user();
        $findUser = User::where('email', $facebookUser->email)->first();
        
        if($findUser){
            Auth::login($findUser, true);
            $this->userStore();
            return redirect(url('user/account/profile/'));
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
        $this->userStore();
        return redirect('user/account/profile/');
        
    }
    //end facebook

    //google login
    public function loginGoogle(){
        return Socialite::driver('google')
        ->redirect();
    }

    public function googleCallback(Request $request){
        $googleUser = Socialite::driver('google')->stateless()->user();
        $findUser = User::where('email', $googleUser->email)->first();
        
        if($findUser){
            Auth::login($findUser, true);
            $this->userStore();
            return redirect(url('user/account/profile/'));
        }
        else{
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'password'=> Hash::make(Str::random(11)),
            ]);
            User_attribute::create([
                'id' => $user->id,
                'user_id' => $user->id,
            ]);
        }

        Auth::login($user);
        $this->userStore();
        return redirect('user/account/profile/');
        
    }
    //end google

    
    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input( 'password'),
        ])){
            $this->userStore();
            return redirect(url('/user/account/profile/'));
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

    public function sendResetLink(Request $request){
        if(Auth::check()){
            if($request->email != Auth::user()->email){
                Session()->flash( 'error','Email không đúng');
                return redirect()->back();
            }
            $request->validate([
                'email' => 'required|email|exists:users,email'
            ],[
                'email.required' => 'Chưa nhập email',
                'email.exists' => 'Email này không tồn tại trong hệ thống' 
            ]);
        }
        else{
            $request->validate([
                'email' => 'required|email|exists:users,email'
            ],[
                'email.required' => 'Chưa nhập email',
                'email.exists' => 'Email này không tồn tại trong hệ thống' 
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $password = Password_reset::updateOrCreate([
            'email' => $user->email,
            'token' => Str::random(60),
        ]);
        if($password){
            $user->notify(new ResetPassword($password->token));
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
        $passwordReset = Password_reset::where('token',$data['token'])->firstOrFail();
        $user = User::where('email',$passwordReset->email)->firstOrFail();
        $user->update(['password' => Hash::make($data['password']) ]);
        $passwordReset->delete();

        Session()->flash( 'success','Đổi mật khẩu thành công');
        if(Auth::check()) $this->logouts();
        return redirect('user/login');
    }

    public function logouts(){   
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function update(Request $request){
        $User_attribute = User_attribute::find($request->user_id);
        $User_attribute->update($request->input());
        $User = User::where('id',Auth::id())->update(['name' => $request->input('name')]);
        return response()->json($User_attribute);
    }


    public function userStore(){
        if(Auth::check()){
            $Cart = Cart::updateOrCreate([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
            ]);
            if(Session::has('carts')){
                foreach(Session::get('carts') as $product_id => $details){
                    if(Cart_item::where('product_id',$details['product_id'])->first()){
                        Cart_item::where('product_id',$details['product_id'])
                            ->update([
                                'cart_id' => $Cart->id,
                                'product_id' => $details['product_id'],
                                'name' => $details['name'],
                                'thumb' => $details['thumb'],
                                'quantity' => $details['quantity'],
                                'price' => $details['price'],
                            ]);
                    }
                    else{
                        Cart_item::Create([
                            'cart_id' => $Cart->id,
                            'product_id' => $details['product_id'],
                            'name' => $details['name'],
                            'thumb' => $details['thumb'],
                            'quantity' => $details['quantity'],
                            'price' => $details['price'],
                        ]);
                    }
                }
            }
        }
    }
}
