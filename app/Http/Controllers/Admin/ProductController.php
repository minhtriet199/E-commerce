<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductAdminService;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductAdminService $productService){
        $this->productService = $productService;
    }

    public function index(){
        return view('admin.products.list',[
            'title' => 'Danh sách sản phẩm',
            'products' => $this->productService->get()  
        ]);
    }


    public function create(){
        return view('admin.products.add',[
            'title' => 'Thêm sản phẩm mới',
            'products' => $this->productService->getMenu()
        ]);
    }
    public function store(ProductRequest $request){
        $result = $this->productService->insert($request);
        
        if($result) return redirect('admin/products/list');
        else return redirect()->back()->withInput();
    }

    public function show(Product $id){
        return view('admin.products.edit',[
            'title' => 'Sửa tên sản phẩm',
            'product' => $id,
            'menus' => $this->productService->getMenu()
        ]);
    }

    public function update(Request $request, Product $id){
        $result = $this->productService->update($request,$id);

        if($result) return redirect('admin/products/list');
        else return redirect()->back();
    }

    public function destroy(Request $request){
        $result = $this->productService->delete($request);
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

    public function products_image(){
        return view('admin.products.products_image',[
            'title' => 'Ảnh sản phẩm',
            'products' => Product::with('product_image')
                ->paginate(9),
        ]);
    }
    public function product_image($id){
        return view('admin.products.product_image',[
            'title' => 'Thêm ảnh sản phẩm',
            'product' => Product::where('id',$id)->firstOrFail(),
        ]);
    }
}
