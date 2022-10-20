@extends('main')

@section('content')

<section>
    <div class="container">
        <div class="mid-table finish">
            <h4><i class="fa fa-check" style="color:#55FF2E;margin-bottom:50px;"></i> Mã đơn hàng của bạn là: <span>{{ session('order') }}</span></h4>
            <div class="user_info">
                <div  style="text-align:left; margin-bottom:20px" >
                    <div class="row">
                        <div class="col-lg-8">
                            <h4> Thông tin người nhận</h4>
                        </div>
                        <div class="col-lg-4">
                            {!! Helper::orderStatus($order->status) !!}
                        </div>
                    </div>
                    <hr>
                    <h5><strong>{{ $order->email }}</strong></h5>
                    <h5>{{ $order->username}}</h5>
                    <h6>{{ $order->address}}</h6>
                    <h6>0{{ $order->phone}}</h6>
                </div>
            </div>
            <div class="shopping__cart__table">
                <table id="table-product">
                    <thead>
                        <tr>
                            <td>Hình</td>
                            <td>Tên sản phẩm</td>
                            <td>Số lượng</td>
                            <td>Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $key => $detail)
                            @foreach($detail->order_details as $detail)
                                <tr>
                                    <td> <img src=" {{ $detail -> thumb}}" style="width:100px"></td>
                                    <td>{{ $detail -> product_name }}</td>
                                    <td>{{ $detail -> quantity}}</td>
                                    <td>{{ $detail -> price}} đ</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection