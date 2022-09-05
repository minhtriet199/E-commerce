<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Services\CartServices;
use App\Models\Product;
use Illuminate\Support\Arr;
use Session;

class CartController extends Controller
{
    protected $cartServices;
    
    public function __construct(CartServices $cartServices){
        $this->cartServices = $cartServices;
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
                'name'=> $product_name,
                'price' => $product_price,
                'quantity'  => $quantityNew,
                'thumb' => $product_thumb,
            ];
        }else{
            $carts[$product_id] = [
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
}
