<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\Order_detail;


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
            $html .='
                <input type="hidden" value="'.$Product -> price_sale.'" name="product_price">
            ';
            return $html;
        }
        if($price !=0 ) {
            $html .='
                <input type="hidden" value=" '.$Product -> price.' " name="product_price">
            ';
            return $html;
        }
    }
    

    public static function priceDetail($Product,$price =0,$price_sale=0){
        $html= '';
        if($price_sale != 0) {
            $html .='
                <h3>'. number_format($Product->price_sale,0,',','.') .' đ<span> '. number_format($Product->price,0,',','.') .' đ</span></h3>
            ';
            return $html;
        }
        if($price !=0 ) {
            $html .='
                <h3>'. number_format($Product->price,0,',','.') .' đ </span></h3>
            ';
            return $html;
        }
        return '<a href="">lien he</a>';
    }

    public static function orderStatus($status =0){
        $html= '';
        switch($status){
            case "1":
                $html .='<h5 class="order-status">Đang chờ xác nhận</h5>';
                return $html;
                break;
            case "2":
                $html .='<h5 class="order-status">Đang vận chuyển</h5>';
                return $html;
                break;
            case "3":
                $html .='<h5 class="order-status">Giao hàng thành công</h5>';
                return $html;
                break;
            default: 
                $html .='<h5 class="order-status">Đã hoàn tiền</h5>';
                return $html;
                break;
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
                $html .= ' <a class="btn btn-primary btn-lg btn-update-order" data-id="'. $order->id .'"> Giao hàng</a> ';
                return $html;
            case "2":
                $html .= ' <a class="btn btn-primary btn-lg btn-update-order" data-id="'. $order->id .'"> Hoàn thành đơn hàng</a> ';
                return $html;
            case "3":
                $html .='<a class="btn btn-primary btn-lg btn-update-order" data-id="'. $order->id .'"> Hoàn tiền</a>';
                return $html;
            default:
                $html.='<a class="btn btn-primary btn-lg"> Đã hoàn tiền</a>';
                return $html;
        }

    }

}
