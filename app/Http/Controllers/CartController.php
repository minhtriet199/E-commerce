<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


use App\Http\Services\CartServices;
use App\Http\Services\User\UserService;
use App\Http\Controllers\MainController;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Cities;
use App\Models\District;

use Session;

class CartController extends Controller
{
    protected $cartServices;
    protected $mainController;
    
    public function __construct(CartServices $cartServices,UserService $userServices,mainController $mainController){
        $this->cartServices = $cartServices;
        $this->userServices =$userServices;
        $this->mainServices =$mainController;
    }
   

    public function index(){
        return view('block.cart',[
            'title'=> 'Giỏ hàng'
        ]);
    }

    public function user_insert(Request $request){
        $product_id = $request->input('product_id');
        $product_name = $request->input('product_name');
        $product_price = $request->input('product_price');
        $product_quantity =$request->input('product_quantity');
        $product_thumb = $request->input('product_thumb');

        $Cart = Cart::updateOrCreate([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
        ]);
        if(Cart_item::where('cart_id',$cart->id)->first()){
            Cart_item::where('product_id',$details['product_id'])
                ->update([
                    'cart_id' => $Cart->id,
                    'product_id' => $product_id,
                    'name' => $product_name,
                    'thumb' =>  $product_thumb,
                    'quantity' => $product_quantity,
                    'price' =>  $product_price,
                ]);
        }
        else{
            Cart_item::Create([
                'cart_id' => $Cart->id,
                'product_id' => $product_id,
                'name' => $product_name,
                'thumb' =>  $product_thumb,
                'quantity' => $product_quantity,
                'price' =>  $product_price,
            ]);
        }

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

    public function insert(Request $request){
        $product_id = $request->input('product_id');
        $product_name = $request->input('product_name');
        $product_price = $request->input('product_price');
        $product_quantity =$request->input('product_quantity');
        $product_thumb = $request->input('product_thumb');

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
            $this->userStore();
        }
        $data = [];
        $data['carts'] = Arr::exists($carts,$product_id) ?  Session::get('carts') : [];
        return response()->json($data);
        
    }

    public function update(Request $request){
        if($request->id && $request->quantity){
            $carts = Session::get('carts',[]);
            $carts[$request->id]['quantity'] = $request->quantity;
            session()->put('carts', $carts);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request){
        if($request->id) {
            $carts = Session::get('carts',[]);
            if(isset($carts[$request->id])) {
                unset($carts[$request->id]);
                session()->put('carts', $carts);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function user_cart(){
        return view('user.cart',[
            'title' => 'Giỏ hàng',
            'carts' => $this->cartServices->get(),
        ]);
    }

    public function cart_update(Request $request){
        $data = $request->all();
        $cart_item = cart_item::where('product_id',$data['id'])
            ->update(['fee' => $cart_item['cart_item']]);
    }

    public function destroy(Request $request){
        if($request->id) {
            $carts = cart_item::where('product_id' , $request->input('id'))->first();
            if($carts){
                $carts -> delete();
                return true;
            }
            return false;
        }
    }

    public function use_voucher(Request $request){
        $data = $request->all();
        $voucher  = Voucher::where('voucher_code',$data['voucher_code'])->first();
        if($voucher){
           
        }
        else{
           
        }
    }

    public function checkout(){  

        if(Session::has('carts')){
            if(Auth::check()){
                return view('block.user-checkout',[
                    'title' => 'Checkout',
                    'users' => $this->userServices->get(),
                    'carts' => $this->cartServices->get(),
                    'cartid' => $this->cartServices->getCart(),
                    'citys' => Cities::all(),
                ]);
            }
            else{
                return view('block.checkout',[
                    'title' =>'checkout',
                    'citys' => Cities::all(),
                ]);
            }
        }
        else return redirect()->back();
        
    }

    public function sendOrderMail($order){
        Mail::to($order->email)->send(new OrderMail($order));
    }

    public function place_order(Request $request){
        $data = $request->all();
        $address = $data['address'] . " ".$data['district_id'] ." ". $data['city'];
        $user = User::where('email', $data['email'])->firstOrFail();
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 0,
            'total' => $data['total'],
            'username' => $data['user_name'],
            'email' => $data['email'],
            'address' => $address,
            'phone'=>$data['phone'],
        ]);
        if(Auth::check()){
            $carts = Cart_item::where('cart_id',$data['cart_id'])->get();
            foreach($carts as $cart){
                $detail = order_detail::create([
                    'order_id' => $order->id,
                    'product_name' => $cart['name'],
                    'thumb' => $cart['thumb'],
                    'quantity'=> $cart['quantity'],
                    'price' => $cart['price'],
                ]);
            }
            Cart::where('user_id',Auth::id())->delete();
        }
        else{
            foreach(Session::get('carts') as $product_id => $cart){
                $detail = order_detail::create([
                    'order_id' => $order->id,
                    'product_name' => $cart['name'],
                    'thumb' => $cart['thumb'],
                    'quantity'=> $cart['quantity'],
                    'price' => $cart['price'],
                ]);
            }
        }
        $this->sendOrderMail($order);

        Session::forget('carts');
        Session::put('order',$order->id);
        return redirect('/finish');
    }
}
