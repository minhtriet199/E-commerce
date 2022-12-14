<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menus;
use Carbon\Carbon;

class MenusController extends Controller
{
    protected $MenuService;
    public function __construct(MenuService $MenuService)
    {
        $this->MenuService = $MenuService;    
    }

    public function index()
    {
        return view('admin.menus.list',[
            'title' => 'Danh sách danh mục',
            'Menus' => $this->MenuService->get()
        ]);
    }

    public function create()
    {
        return view('admin.menus.add',[
            'title' => 'Thêm danh mục mới',
            'Menus' => $this->MenuService->get()
        ]);
    }
    public function store(CreateFormRequest $request)
    {
        $result = $this->MenuService->create($request);

        return redirect('/admin/menus/list');
    }

    public function show(Menus $id)
    {   
        return view('admin.menus.edit',[
            'title' => 'Chỉnh sửa danh mục : ' . $id->name,
            'Menus' => $id,
        ]);
    }

    public function update(Menus $id, CreateFormRequest $request)
    {
        $this->MenuService->update($request, $id);
        return redirect('/admin/menus/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->MenuService->destroy($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message' => 'Xóa thành công danh mục'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }

}
