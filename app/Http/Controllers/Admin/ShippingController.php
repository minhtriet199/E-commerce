<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping\ShippingRequest;
use App\Models\Cities;
use App\Models\District;
use App\Models\fee;


class ShippingController extends Controller
{
   
    public function index(){
        $fee = fee::all();
        return view('admin.shipping.list',[
            'title' => 'Danh sách giao hàng',
            'fees' => $fee,
        ]);
    }

    public function shippinglist(){
        $city = Cities::all();
        return view('admin.shipping.add',[
            'title' => 'Vận chuyển',
            'citys' => $city,
        ]);
    }

    // Using ajax to print out the district of user selected city
    // More in public\assets\admin\js\main.js and find .choose
    public function select_delivery(Request $request){
        $data = $request->all();
        $output= '';
        if($data['action']){
            if($data['action']=="city"){
                $select_district = District::where('city_id',$data['city_id'])->orderBy('id','ASC')->get();
                $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_district as $key =>$districts){
                    $output.='<option value="'.$districts->id .'">'. $districts->name .'</option>;';
                }
            }
            echo $output;
        }
    }
    public function insert_delivery(ShippingRequest $request){
        $data = $request->all();
        $fee = fee::create([
            'city_id' => $data['city'],
            'district_id' => $data['district'],
            'fee' => $data['fee'],
        ]);
    }
    
    public function update_fee(Request $request){
        $data = $request->all();
        $fee = fee::where('id',$data['id'])
                ->update(['fee' => $data['fee']]);
        return response()->json();
    }
    public function remove_row(Request $request){
        $data = $request->all();
        fee::where('id',$data['id'])
            ->delete();
        return response()->json();
    }
}
