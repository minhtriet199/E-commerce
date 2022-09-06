<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\District;
use App\Models\fee;

class OrderController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }

    public function show_delivery(){
        $city = Cities::all();
        return view('admin.users.showship',[
            'title' => 'Danh sách giao hàng',
            'cities' => $city,
        ]);
    }

    public function shippinglist(){
        $city = Cities::all();
        return view('admin.users.shipping',[
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
}
