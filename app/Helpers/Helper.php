<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Voucher;

use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Session;


class Helper{
    public static function active($active = 0){   
        return $active == 0 ? '<span class="btn btn-danger btn-sm"> Ngưng hoạt động </span>'
        : '<span class="btn btn-success btn-sm"> Hoạt động </span>';

    }

    public static function menus($Menus) {
        $html = '';
        foreach ($Menus as $key => $menu) {
                $html .= ' 
                    <a href="/shop/'. $menu-> slug. '">
                        ' . $menu->name . '
                    </a>';
                unset($Menus[$key]);
                $html .= '';
        }
        return $html;
    }

    public static function formprice($Product,$price =0,$price_sale=0){
        $html ='';
        if($price_sale != 0) {
            return $html .='
                <input type="hidden" value="'.$Product -> price_sale.'" name="product_price">
            ';
        }
        if($price !=0 ) {
            return $html .='
                <input type="hidden" value=" '.$Product -> price.' " name="product_price">
            ';
        }
    } 

    public static function priceDetail($Product,$price =0,$price_sale=0){
        $html= '';
        if($price_sale != 0) {
            return  $html .='
                <h3>'. number_format($Product->price_sale,0,',','.') .' đ<span> '. number_format($Product->price,0,',','.') .' đ</span></h3>
            ';
        }
        if($price !=0 ) {
            return  $html .='
                <h3>'. number_format($Product->price,0,',','.') .' đ </span></h3>
            ';
        }
        else return $html='<a href="">lien he</a>';
    }

    public static function orderStatus($status =0){
        $html= '';
        switch($status){
            case "4":
                return $html .='<h5 class="order-status">Đã hoàn tiền</h5>';
            case "2":
                return $html .='<h5 class="order-status">Đang vận chuyển</h5>';
            case "3":
                return $html .='<h5 class="order-status">Giao hàng thành công</h5>';
            default: 
                return $html .='<h5 class="order-status">Đang chờ xác nhận</h5>';
        }
    }

    public static function product($product,$price =0,$price_sale=0){
        $html= '';
        if($price_sale != 0) {
            $html = ' 
                <div class="product__item">
                    <a href="/product/'. $product->slug .'">
                        <div class="product__item__pic set-bg" data-setbg="'. $product->thumb .'" style="background-image: url('. $product->thumb. ')">
                            <span class="label" style="width:150px;border:none">Giảm giá</span>
                            <ul class="product__hover">
                                <span class="label" class="product__hover"><h6>'. $product->name .'</h6></span>
                            </ul>
                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>'. $product->name .'</h6>
                        <a href="/product/{{$product->slug}}" class="add-cart">+ Xem chi tiết</a>
                        '. number_format($product->price_sale,0,',','.') .' đ
                    </div>
                </div>
            ';
            return $html;
        }
        if($price !=0 ) {
            $html = ' 
                <div class="product__item">
                    <a href="/product/'. $product->slug .'">
                        <div class="product__item__pic set-bg" data-setbg="'. $product->thumb .'" style="background-image: url('. $product->thumb. ')">
                            <ul class="product__hover">
                                <span class="label" class="product__hover"><h6>'. $product->name .'</h6></span>
                            </ul>
                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>'. $product->name .'</h6>
                        <a href="/product/{{$product->slug}}" class="add-cart">+ Xem chi tiết</a>
                        '. number_format($product->price,0,',','.') .' đ 
                    </div>
                </div>
            ';
        return $html;
        }
    }
    
    public static function order_button($order,$status =0){
        $html ='';
        switch($status){
            case "1":
                return $html .= ' <a class="btn btn-primary btn-lg btn-update-order" data-id="'. $order->id .'"> Giao hàng</a> ';
            case "2":
                return   $html .= ' <a class="btn btn-primary btn-lg btn-update-order" data-id="'. $order->id .'"> Hoàn thành đơn hàng</a> ';
            case "3":
                return $html .='<a class="btn btn-primary btn-lg btn-update-order" data-id="'. $order->id .'"> Hoàn tiền</a>';
            default:
                return   $html.='<a class="btn btn-primary btn-lg"> Đã hoàn tiền</a>';
        }

    }

    public static function user_status($role){
        $html ='';
        switch($role){
            case "0" :
                return $html = '<a class=" btn btn-primary">Khách hàng</a>';
            case "1" :
                return $html = '<a class=" btn btn-success">Admin</a>';
            case "2" :
                return $html = '<a class=" btn btn-warning">Owner</a>';
            default :
                return $html = '<a class=" btn btn-danger">Error</a>';
        }
    }

    public static function countCart(){
        $html ='';
        if(Auth::check()){
            $cart = Cart::where('user_id',Auth::id())->first();
            if(!$cart){
                $countCart = Cart_item::select('*')
                ->where('cart_id',$cart['id'])
                ->sum('quantity');
                return $html.= $countCart;
            }
            else{
                return $html .= '0';
            }
        }
        else {
            if(!Session::has('carts')){
                return $html.= '0';
            }
            $sum =0 ;
            foreach(Session::get('carts') as $product_id => $details){
                $sum += $details['quantity'];
            }
            return $html.= $sum; 
        }
    }

    public static function notify_status($active){
        $html = '';
        if($active == 0)
            $html .= '<i class="fas fa-circle mr-2" style="color:red;"></i>';
        else
            $html .= '<i class="fas fa-envelope mr-2"></i> ';

        echo $html;
    }
}
