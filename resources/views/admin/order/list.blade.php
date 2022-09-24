@extends('admin.users.main')

@section('content')

<div class="card">
    <div class="card-header">
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
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày tạo đơn</th>
                    <th>Khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái đơn hàng</th>
                    <th style="width:120px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $key => $order)  
                    <tr>
                        <th><a href="/admin/order/edit/{{$order->id}}">{{$order->id}}</a></th>
                        <th>{{ $order->created_at->format('d/m/y') }}</th>
                        <th>{{ $order->username }}</th>
                        <th>0{{ $order->phone }}</th>
                        <th>{{ number_format($order->total,0,',','.') }} đ</th>
                        <th>{!! \App\Helpers\Helper::orderStatus($order->status) !!}</th>
                        <th>{!! \App\Helpers\Helper::order_button($order,$order->status) !!} <input type="hidden" value="{{ $order->id}}" class="order_id"></th>
                    </tr> 
                @endforeach
            </tbody>
        </table>
        <div class="card-footer clearfix">
            {!! $orders->links() !!}
        </div>
    </div>
</div>

@endsection