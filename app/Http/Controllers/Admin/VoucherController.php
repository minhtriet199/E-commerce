<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Voucher\VoucherService;
use App\Http\Requests\Voucher\VoucherRequest;
use App\Models\Voucher;

class VoucherController extends Controller
{
   
    protected $voucherService;
    public function __construct(VoucherService $voucherService){
        $this->voucherService = $voucherService;
    }
    public function index()
    {
        return view('admin.voucher.list',[
            'title' => 'Voucher',
            'vouchers' => Voucher::all(),
        ]);
    }
    public function create(){
        return view('admin.voucher.add',[
            'title' => 'Thêm voucher'
        ]);
    }

    public function store(VoucherRequest $request){
        $result = $this->voucherService->insert($request);
        
        if($result) return redirect('admin/voucher/list');
        else return redirect()->back()->withInput();
    }

    public function update(Request $request){
        $data = $request->all();
        Voucher::where('id',$data['id'])
            ->update(['discount' => $data['discount']]);
    }

}
