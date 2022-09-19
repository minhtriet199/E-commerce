@extends('admin.users.main')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-4">
                <p><strong> Mã đơn hàng:</strong> {{$orders -> id}}</p>
                <p><strong> Tên khách hàng:</strong> {{$orders -> username}}</p>
                <p><strong> Địa chỉ giao hàng:  </strong>{{$orders -> address}}</p>
                <p><strong> Email: </strong> {{$orders -> email}}</p>
                <p><strong> Số điện thoại: </strong>  0{{$orders->phone}}</p>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap" >
            <thead>
                <tr>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $detail)
                    <tr>
                        <td><img src="{{ $detail->thumb }}" class="admin-thumb"> </td>
                        <td>{{$detail->product_name}}</td>
                        <td>{{$detail->quantity}}</td>
                        <td>{{number_format($detail->price,0,',',',')}} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer clearfix">
            <div class="row order-bottom">
                <div class="col col-lg-10">
                    <span>Tạm tính: </span>
                </div>
                <div class="col col-lg-2">
                    <span>{{ number_format($orders -> total,0,',',',',) }} đ</span>
                </div>
            </div>
            <div class="row order-bottom">
                <div class="col col-lg-10">
                    <span>Tổng tiền: </span>
                </div>
                <div class="col col-lg-2">
                   <span> {{ number_format($orders -> total,0,',',',',) }} đ</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

@endsection