<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Requests\Menu\UpdateRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menus;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class MenusController extends Controller
{
    protected $MenuService;

    public function index()
    {
        return view('admin.menus.list',[
            'title' => 'Danh sách danh mục',
            'menus' => $this->MenuService->get_cata()
        ]);
    }

    public function __construct(MenuService $MenuService)
    {
        $this->MenuService = $MenuService;    
    }

    public function create()
    {
        return view('admin.menus.add',[
            'title' => 'Thêm danh mục mới',
            'Menus' => $this->MenuService->get_cata(0)
        ]);
    }
    public function store(CreateFormRequest $request)
    {
        $result = $this->MenuService->create($request);

        return redirect()->back();
    }

    public function show(Menus $menus)
    {   
        return view('admin.menus.edit',[
            'title' => 'Chỉnh sửa danh mục : ' . $menus->name,
            'Menus' => $menus,
            'menus' => $this->MenuService->get_cata()
        ]);
    }
    public function update(Menus $menus, UpdateRequest $request)
    {
        $this->MenuService->update($request, $menus);

        return redirect('/admin/menus/list');
    }

    public function destroy(Request $request): JsonResponse
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
