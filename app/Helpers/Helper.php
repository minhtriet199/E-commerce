<?php

namespace App\Helpers;

class Helper{
    public static function menu($Menus, $parent_id = 0, $char = ''){
        $html= '';

        foreach ($Menus as $key => $menu){
            if($menu->parent_id ==$parent_id){
                $html .='
                    <tr>
                        <td>'. $menu->id .'</td>
                        <td>'. $char. $menu->name .'</td>
                        <td>'. $menu->active .'</td>
                        <td>'. $menu->updated_at .'</td>
                        <td>  </td>
                    </tr>';

                unset($Menus[$key]);

                $html .=self::menu($Menus, $menu->id, $char .'--');
            }
        }

        return $html;
    }
}
