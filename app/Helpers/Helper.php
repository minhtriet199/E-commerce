<?php

namespace App\Helpers;

class Helper{
    public static function active($active = 0)
    {   
        return $active == 0 ? '<span class="btn btn-danger btn-sm"> Ngưng hoạt động </span>'
        : '<span class="btn btn-success btn-sm"> Hoạt động </span>';

    }

    public static function currency_format($number, $suffix = 'Đồng') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . " {$suffix}";
        }
    }

    public static function menus($Menus) 
    {
        $html = '';
        foreach ($Menus as $key => $menu) {
                $html .= ' 
                        <a href="/shop/'. $menu-> slug. '.html">
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
                <h4 style="color:red; padding-top:5px">'. self::currency_format($Product ->price_sale).'</h4>
            ';
            return $html;
        }
        if($price !=0 ) {
            $html .='
                <h4>'. self::currency_format($Product ->price).'</h4>
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

    
}
