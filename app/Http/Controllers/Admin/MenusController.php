<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;


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
}
