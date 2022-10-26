<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Slider\AdminSliderService;
use App\Http\Services\UploadServices;
use App\Http\Requests\Slider\SliderRequest;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $sliderService;
    protected $upload;

    public function __construct(AdminSliderService $sliderService,UploadServices $upload){
        $this->sliderService = $sliderService;
        $this->upload =$upload;
    }

    public function index(){
        return view('admin.sliders.list',[
            'title' => 'Danh sách slider',
            'sliders' => $this->sliderService->get()
        ]);
    }

    
    public function create(){
        return view('admin.sliders.add',[
            'title' => 'Thêm slider'
        ]);
    }
    public function store(SliderRequest $request){
        $name = time().rand(1,100).'.png';
        $thumb = '/storage/uploads/'.date("Y/m/d").'/'.$name;

        $result = $this->sliderService->insert($request,$thumb);
        $this->upload->store($request,$name);
        if($result) return redirect('admin/sliders/list');
        else return redirect()->back()->withInput();
    }

    public function show(Slider $id){
        return view('admin.sliders.edit',[
            'title' => 'Sửa tên sản phẩm',
            'slider' => $id   
        ]);
    }


    public function update(Request $request, Slider $id){
        $name = time().rand(1,100).'.png';
        $thumb = '/storage/uploads/'.date("Y/m/d").'/'.$name;
        if($request->input('file') != ''){
            $this->upload->store($request,$thumb);
        }
        $result = $this->sliderService->update($request,$id);
        if($result) return redirect('admin/sliders/list');
        else return redirect()->back();
    }

    public function destroy(Request $request) {
        $slider = Slider::where('id' , $request->input('id'))->first();
        $result = $this->sliderService->delete($slider);
        unlink(public_path($slider->thumb));
        if($result){
            return response()->json([
                'error'=>false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }
}
