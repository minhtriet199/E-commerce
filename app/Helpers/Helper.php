<?php

namespace App\Helpers;

class Helper{
    public static function active($active = 0)
    {   
        return $active == 0 ? '<span class="btn btn-danger btn-sm"> Ngưng hoạt động </span>'
        : '<span class="btn btn-success btn-sm"> Hoạt động </span>';

    }

    public static function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . " {$suffix}";
        }
    }

    public static function menus($Menus) 
    {
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

    public static function price($Product,$price =0,$price_sale=0)
    {
        $html= '';
        if($price_sale != 0) {
            $html .='
                <h7 style="text-decoration:line-through;">'. self::currency_format($Product ->price).'</h7>
                <h5 style="color:red; padding-top:5px">'. self::currency_format($Product ->price_sale).'</h5>
            ';
            return $html;
        }
        if($price !=0 ) {
            $html .='
                <h5>'. self::currency_format($Product ->price).'</h5>
            ';
            return $html;
        }
        return '<a href="">lien he</a>';
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
    

    public static function priceDetail($Product,$price =0,$price_sale=0)
    {
        $html= '';
        if($price_sale != 0) {
            $html .='
                <h3>'. self::currency_format($Product ->price_sale).' <span> '.self::currency_format($Product-> price).'</span></h3>
            ';
            return $html;
        }
        if($price !=0 ) {
            $html .='
                <h3>'.self::currency_format($Product -> price).'</span></h3>
            ';
            return $html;
        }
        return '<a href="">lien he</a>';
    }

    public static function orderStatus($status =0){
        $html= '';
        if($status == 0) {
            $html .='<h5 class="order-status">Đang chờ xác nhận</h5>';
            return $html;
        }
        if($status ==1 ) {
            $html .='<h5 class="order-status">Đang vận chuyển</h5>';
            return $html;
        }
        return '<h5 class="order-status">Giao hàng thành công</h5>';
    }
    
}
