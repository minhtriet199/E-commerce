<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\ProductImageRequest;
use App\Http\Services\UploadServices;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Product;
use App\Models\Product_image;

class ProductController extends Controller
{
    protected $productService;
    protected $upload;

    public function __construct(ProductAdminService $productService,UploadServices $upload){
        $this->productService = $productService;
        $this->upload =$upload;
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
        $name = time().rand(1,100).'.png';
        $thumb = '/storage/uploads/'.date("Y/m/d").'/'.$name;
        $result = $this->productService->insert($request,$thumb);
        $this->upload->store($request,$name);
        if($result) return redirect('admin/products/list');
        else return redirect()->back()->withInput();
    }

    public function show(Product $id){
        return view('admin.products.edit',[
            'title' => 'Sửa sản phẩm',
            'product' => $id,
            'menus' => $this->productService->getMenu()
        ]);
    }

    public function update(Request $request, Product $id){
        $name = time().rand(1,100).'.png';
        $thumb = '/storage/uploads/'.date("Y/m/d").'/'.$name;
        if($request->input('file') != ''){
            $this->upload->store($request,$name);
        }
        $result = $this->productService->update($request,$id);
        if($result) return redirect('admin/products/list');
        else return redirect()->back();
    }

    public function destroy(Request $request){
        $product = Product::where('id',$request['id'])->first();
        $result = $this->productService->delete($product);
        unlink(public_path($product->thumb)); //Remove image after delete product
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
            'id' => $id,
            'product' => Product::where('id',$id)->first(),
        ]);
    }
    public function store_image(ProductImageRequest $request){
        $file = $request->file('file');
        foreach($file as $photo){
            $name = time().rand(1,100).'.png';
            $this->upload->store_multi($photo,$name);
            Product_image::create([
                'product_id' => $request->input('product_id'),
                'image' => '/storage/uploads/'.date("Y/m/d").'/'.$name,
            ]);
        }
        Session()->flash( 'success','Thành công');
        return redirect()->back();
    }
}
