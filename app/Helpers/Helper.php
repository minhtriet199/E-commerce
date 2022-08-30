<?php

namespace App\Helpers;

class Helper{
    public static function menu($Menus, $parent_id = 0, $char = '')
    {
        $html= '';

        foreach ($Menus as $key => $menu){
            if($menu->parent_id ==$parent_id){
                $html .='
                    <tr>
                        <td>'. $menu->id .'</td>
                        <td>'. $char. $menu->name .'</td>
                        <td >'. self::active($menu->active) .'</td>
                        <td>'. $menu->updated_at->format('d/m/y | H:i:s') .'</td>
                        <td>  
                            <a class="btn btn-primary btn-sm"  href="/admin/menus/edit/' . $menu->id . ' "><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('.$menu->id.',\'/admin/menus/destroy\')"> <i class="fas fa-trash"></i> </a>
                        </td>
                    </tr>';

                unset($Menus[$key]);

                $html .=self::menu($Menus, $menu->id, $char .'--');
            }
        }

        return $html;
    }
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

    public static function menus($Menus ) 
    {
        $html = '';
        foreach ($Menus as $key => $menu) {
                $html .= '
                    <li>
                        <a href="/shop/' . $menu->id . '-' . $menu-> slug. '.html">
                            ' . $menu->name . '
                        </a>';

                unset($Menus[$key]);


                $html .= '</li>';
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
    
    public static function Shophelp($menus)
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            $html .='
                <a href="/shop/'.$menu-> slug. '.html">
                    ' . $menu->name . '
                </a>';
        }
        return $html;
    }
    
}
