<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Http\Services\CartServices;
use App\Http\Services\User\UserService;
use App\Http\Services\Order\OrderService;
use App\Http\Requests\User\UserInfomationRequest;
use App\Jobs\sendMailOrder;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Cities;
use App\Models\District;
use App\Models\Notification;
use Pusher\Pusher;


use Carbon\Carbon;

use Session;

class CartController extends Controller
{
    protected $cartServices;
    protected $mailServices;
    protected $orderServices;
    
    public function __construct(CartServices $cartServices,UserService $userServices,OrderService $orderServices){
        $this->cartServices = $cartServices;
        $this->userServices =$userServices;
        $this->orderServices = $orderServices;
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
        $product = $request->all();

        $carts = Session::get('carts',[]);
        $exist = Arr::exists($carts,$product['product_id']);
        if($exist){
            $quantityNew = $carts[$product['product_id']]['quantity'] + $product['product_quantity'];
            $carts[$product['product_id']] =[
                'product_id' => $product['product_id'],
                'name'=> $product['product_name'],
                'price' => $product['product_price'],
                'quantity'  => $quantityNew,
                'thumb' => $product['product_thumb'],
            ];
        }else{
            $carts[$product['product_id']] = [
                'product_id' => $product['product_id'],
                'name'=> $product['product_name'],
                'price' => $product['product_price'],
                'quantity' => $product['product_quantity'],
                'thumb' => $product['product_thumb'],
            ];
        }
        
        $request ->session()->put('carts', $carts);
        if(Auth::check()){
            $this->cartServices->userStore();
        }
        //Insert cart pusher will update cart number
        $data['amount'] = $product['product_quantity'];
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => false
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $pusher->trigger('AddCart', 'addCart', $data);

        $data = [];
        $data['carts'] = Arr::exists($carts,$product['product_id']) ?  Session::get('carts') : [];
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
                $carts = cart_item::where('product_id' , $request->input('id'))->first();
                $carts->delete();
            }
            else{
                $carts = Session::get('carts',[]);
                if(isset($carts[$request->id])) {
                    unset($carts[$request->id]);
                    session()->put('carts', $carts);
                }
            }
        }

        // $options = array(
        //     'cluster' => 'ap1',
        //     'encrypted' => true
        // );

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );
        // $pusher->trigger('DecreasedCart', 'decreasedCart', $data);
        
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
                $Cart_item = Cart_item::where('cart_id', $Cart->id)->first();
                return view('block.user-checkout',[
                    'title' => 'Checkout',
                    'account' => $this->userServices->get(),
                    'carts' => $this->cartServices->get(),
                    'cartid' => $this->cartServices->getCart(),
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

    public function place_order(UserInfomationRequest $request){
        $data = $request->all();
        $address = $data['address'] . " ".$data['district'] ." ". $data['city'];
        $user = User::where('email', $data['email'])->firstOrFail();
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $data['total'],
            'username' => $data['user_name'],
            'email' => $data['email'],
            'address' => $address,
            'City' => $data['city'],
            'district' => $data['district'],
            'phone'=>$data['phone'],
        ]);
        if(Auth::check()){
            $carts = Cart_item::where('cart_id',$data['cart_id'])->get();
            foreach($carts as $cart){
                $detail = $this->orderServices->insertOrderDetail($order,$cart);
                $product = Product::where('name',$detail->product_name)->decrement('amount',$detail->quantity);
            }
            Cart::where('user_id',Auth::id())->delete();
        }
        else{
            foreach(Session::get('carts') as $product_id => $cart){
                $detail = $this->orderServices->insertOrderDetail($order,$cart);
                $product = Product::where('name',$detail->product_name)->decrement('amount',$detail->quantity);
            }
        }
        dispatch(new sendMailOrder($order));
        $notification = Notification::create([
            'order_id' => $order->id,
            'content' => 'Đơn hàng mới',
            'active' => '0',
        ]);


        $data['title'] = $notification['order_id'];
        $data['content'] = $notification['content'];
        $data['created_at'] = $notification['created_at'];

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('Notify', 'send-notify', $data);

        Session::forget('carts');
        Session::put('order',$order->id);
        return redirect('/finish');
    }

    public function use_voucher(Request $request){
        $voucher = Voucher::where('voucher_code',$request->voucher)->first();
        if($voucher)
            return response()->json([
                'error' => true,
                'discount' => $voucher->discount
            ]);
        else 
        return response()->json([
            'error' => false,
        ]);
       
    }

}