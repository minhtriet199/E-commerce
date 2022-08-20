<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductAdminService;
use App\Http\Services\Menu\MenuService;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductAdminService $productService, MenuService $MenuService)
    {
        $this->productService = $productService;
        $this->MenuService = $MenuService;    
    }

    public function index()
    {
        return view('admin.products.list',[
            'title' => 'Danh sách sản phẩm',
            'products' => $this->productService->get()
        ]);
    }


    public function create()
    {
        return view('admin.products.add',[
            'title' => 'Thêm sản phẩm mới',
            'products' => $this->productService->getMenu(),
            'Menus' => $this->MenuService->get_cata(2)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->productService->insert($request);

        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
