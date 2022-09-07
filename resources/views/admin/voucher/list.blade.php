@extends('admin.users.main')

@section('content')

<div class="card">
    <div class="card-header">
        <a href="/admin/voucher/add" type="submit" class="btn btn-primary" style="float:left">Thêm</a>
        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 300px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Tìm kiếm...  " style="font-size:15px;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0" id="table-fee">
        <table class="table table-hover text-nowrap" >
            <thead>
                <tr>
                    <th>Mã Voucher</th>
                    <th>Giảm</th>
                    <th>Số lượng</th>
                    <th>Ngày hết hạn</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
                @foreach($vouchers as $voucher)
                    <tr>
                        <th>{{ $voucher->voucher_code}}</th>
                        <th contenteditable="true" data-id="{{ $voucher->id }}" class="discount-edit">{{ number_format($voucher->discount,0,',','.')}}</th>
                        <th>{{ $voucher->quantity}}</th>
                        <th>{{ $voucher->expire_date}}</th>
                        <th>{!! \App\Helpers\Helper::active($voucher->active) !!}</th>
                    </tr>
                @endforeach
            <tbody >
            
            </tbody>
        </table>
        <div class="card-footer clearfix">
        </div>
    </div>
</div>

@endsection