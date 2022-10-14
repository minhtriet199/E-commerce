<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Http\Services\CartServices;
use App\Http\Services\User\UserService;
use App\Http\Services\MailServices;
use App\Jobs\sendMail;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Cities;
use App\Models\District;
use Carbon\Carbon;

use Session;

class CartController extends Controller
{
    protected $cartServices;
    protected $mailServices;
    protected $mainController;
    
    public function __construct(CartServices $cartServices,UserService $userServices,MailServices $mailServices){
        $this->cartServices = $cartServices;
        $this->userServices =$userServices;
        $this->mailServices =$mailServices;
    }
   

    public function index(){
        if(Auth::check()) {
            return view('block.cart',[
                'title'=> 'Giỏ hàng',
                'carts' =>  $this->cartServices->get(),
                'voucher' => Cart::select('voucher')->where('user_id',Auth::id())->first(),
            ]);
        }
        else{
            return view('block.cart',[
                'title'=> 'Giỏ hàng',
            ]);
        }
       
    }

    public function insert(Request $request){
        $product_id = $request->product_id;
        $product_name = $request->product_name;
        $product_price = $request->product_price;
        $product_quantity =$request->product_quantity;
        $product_thumb = $request->product_thumb;

        $carts = Session::get('carts',[]);
        $exist = Arr::exists($carts,$product_id);
        if($exist){
            $quantityNew = $carts[$product_id]['quantity'] + $product_quantity;
            $carts[$product_id] =[
                'product_id' => $product_id,
                'name'=> $product_name,
                'price' => $product_price,
                'quantity'  => $quantityNew,
                'thumb' => $product_thumb,
            ];
        }else{
            $carts[$product_id] = [
                'product_id' => $product_id,
                'name'=> $product_name,
                'price' => $product_price,
                'quantity' => $product_quantity,
                'thumb' => $product_thumb,
            ];
        }
        
        $request ->session()->put('carts', $carts);
        if(Auth::check()){
            $this->cartServices->userStore();
        }
        $data = [];
        $data['carts'] = Arr::exists($carts,$product_id) ?  Session::get('carts') : [];
        return response()->json($data);
        
    }

    public function update(Request $request){
        if($request->id && $request->quantity){
            if(Auth::check()){
                $carts = Cart::where('user_id',Auth::id())->first();
                $item = Cart_item::where('cart_id',$carts->id)->where('product_id',$request->id)
                ->update(['quantity' => $request->quantity]);
            }
            else{
                $carts = Session::get('carts',[]);
                $carts[$request->id]['quantity'] = $request->quantity;
                session()->put('carts', $carts);
            }
        }
    }

    public function remove(Request $request){
        if($request->id) {
            if(Auth::check()){
                $carts = cart_item::where('product_id' , $request->input('id'))->delete();
            }
            else{
                $carts = Session::get('carts',[]);
                if(isset($carts[$request->id])) {
                    unset($carts[$request->id]);
                    session()->put('carts', $carts);
                }
            }
        }
    }

    public function cart_update(Request $request){
        $data = $request->all();
        $cart_item = cart_item::where('product_id',$data['id'])
            ->update(['fee' => $cart_item['cart_item']]);
        return $cart_item;
    }
    
    public function checkout(){    
        if(Auth::check()){
            $Cart= Cart::where('user_id', Auth::id())->first();
            if($Cart){
                $Cart_item = Cart_item::where('cart_id', $Cart->id)->firstOrFail();
                return view('block.user-checkout',[
                    'title' => 'Checkout',
                    'account' => $this->userServices->get(),
                    'carts' => $this->cartServices->get(),
                    'cartid' => $this->cartServices->getCart(),
                    'voucher' => Cart::select('voucher')->where('user_id',Auth::id())->first(),
                    'districts' => $this->userServices->user_district(Auth::id()),
                    'cities' => Cities::all(),
                ]);
            }
            else return redirect()->back();
        }
        else{
            if(Session::has('carts')){
                return view('block.checkout',[
                    'title' =>'checkout',
                    'cities' => Cities::all(),
                ]);
            }
            else return redirect()->back();
        }  
    }

    public function place_order(Request $request){
        $data = $request->all();
        $address = $data['address'] . " ".$data['district'] ." ". $data['city_id'];
        $user = User::where('email', $data['email'])->firstOrFail();
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $data['total'],
            'username' => $data['user_name'],
            'email' => $data['email'],
            'address' => $address,
            'City' => $data['city_id'],
            'district' => $data['distrcit'],
            'phone'=>$data['phone'],
        ]);
        if(Auth::check()){
            $carts = Cart_item::where('cart_id',$data['cart_id'])->get();
            foreach($carts as $cart){
                $detail = $this->cartServices->insert_cart_detail($order,$cart);
                $product = Product::where('name',$detail->product_name)->decrement('amount',$detail->quantity);
            }
            Cart::where('user_id',Auth::id())->delete();
        }
        else{
            foreach(Session::get('carts') as $product_id => $cart){
                $detail = $this->cartServices->insert_cart_detail($order,$cart);
                $product = Product::where('name',$detail->product_name)->decrement('amount',$detail->quantity);
            }
        }
        dispatch(new sendMail($order));
        Session::forget('carts');
        Session::put('order',$order->id);
        return redirect('/finish');
    }

    public function use_voucher(Request $request){
        $output= '';
        $voucher = Voucher::where('voucher_code',$request->voucher)->firstOrFail();
        if($voucher){
            $output.=  ' <span>'.number_format($voucher->discount,0,',',',').'đ<span>' ;
            if(Auth::check()){
                Cart::where('user_id',Auth::id())->update(['voucher'=>$voucher->discount]);
            }
        }
        else{
            Alert::warning('voucher không đúng', 'Warning Message');
        }
       
        return response()->json(['result'=> $output]);

    }

}