<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function insert_delivery(Request $request){
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
            ->dump();
        return response()->json();
    }
}
