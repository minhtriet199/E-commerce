<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Services\CartServices;
use App\Http\Services\User\UserService;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_item;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Session;

class CartController extends Controller
{
    protected $cartServices;
    
    public function __construct(CartServices $cartServices,UserService $userServices){
        $this->cartServices = $cartServices;
        $this->userServices =$userServices;
    }
    public function index(){
        return view('block.cart',[
            'title'=> 'Giỏ hàng'
        ]);
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
    
        $data = [];
        $data['carts'] = Arr::exists($carts,$product_id) ?  Session::get('carts') : [];
        return response()->json($data);
        
    }
    /*
    public function userCart(Request $request){
        $product_id = $request->input('product_id');
        $product_name = $request->input('product_name');
        $product_price = $request->input('product_price');
        $product_quantity =$request->input('product_quantity');
        $product_thumb = $request->input('product_thumb');

        if(Auth::check()){
            //Tìm cart có tồn tại chưa
            $findCart = Cart::where('user_id',Auth::id())->first();

            if($findCart){
                //Nếu tồn tại kiểm tra trong cart_item có sản phẩm chưa để update số lượng
                $exists =  Cart_item::where('product_id',$product_id)->first();  
                if($exsits){

                }
                //Nếu cart_item chưa tồn tại thì thêm vào
                else{
                    //Kiểm tra session có tồn tại để thêm từ session vào
                    if(Session::has('carts')){
                        foreach (Session::get('carts') as $product_id=>$cart){
                            
                        }
                    }
                }
            }
            else{
                $Cart = Cart::create([
                    'user_id' => Auth::id(),
                    'user_name' => Auth::user()->name,
                ]);
                if(Session::has('carts')){
                    foreach (Session::get('carts') as $product_id=>$carts){
                        Cart_item::create([
                            'cart_id' => $Cart->id,
                            'product_id' => $carts['product_id'],
                            'name' => $cart['name'],
                            'thumb' => $cart['thumb'],
                            'quantity' => $cart['quantity'],
                            'price' => $cart['price'],
                        ]);
                    }
                }
                else{
                    Cart_item::create([
                        'cart_id' => $Cart->id,
                        'product_id' => $product_id,
                        'name' => $product_name,
                        'thumb' => $product_thumb,
                        'quantity' => $product_quantity,
                        'price' => $product_price,
                    ]);
                }
            }
            
        }
    }
    */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $carts = Session::get('carts',[]);
            $carts[$request->id]['quantity'] = $request->quantity;
            session()->put('carts', $carts);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $carts = Session::get('carts',[]);
            if(isset($carts[$request->id])) {
                unset($carts[$request->id]);
                session()->put('carts', $carts);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkout(){
       
        if(Auth::check()){
            return view('block.user-checkout',[
                'title' => 'Checkout',
                'users' => $this->userServices->get(),
            ]);
        }
        else{
            return view('block.checkout',[
                'title' =>'checkout',
            ]);
        }
       
    }
}
