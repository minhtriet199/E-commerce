<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Services\Slider\AdminSliderService;
use App\Http\Requests\Slider\SliderRequest;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(AdminSliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    public function index()
    {
        return view('admin.sliders.list',[
            'title' => 'Danh sách slider',
            'sliders' => $this->sliderService->get()
        ]);
    }

    
    public function create()
    {
        return view('admin.sliders.add',[
            'title' => 'Thêm slider'
        ]);
    }
    public function store(SliderRequest $request)
    {
        $result = $this->sliderService->insert($request);

        if($result) return redirect('admin/sliders/list');
        else return redirect()->back()->withInput();
    }

    public function show(Slider $id)
    {
        return view('admin.sliders.edit',[
            'title' => 'Sửa tên sản phẩm',
            'slider' => $id   
        ]);
    }


    public function update(Request $request, Slider $id)
    {
        $result = $this->sliderService->update($request,$id);

        if($result) return redirect('admin/sliders/list');
        else return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->sliderService->delete($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
