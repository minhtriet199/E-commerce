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

    public static function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }


}
