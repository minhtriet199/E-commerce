@extends('main')

@section('content')

<section>
    <div class="container">
        <div class="mid-table finish">
            <h4><i class="fa fa-check" style="color:#55FF2E;margin-bottom:50px;"></i> Mã đơn hàng của bạn là: <span>{{ session('order') }}</span></h4>
            <div class="user_info">
                <div class="row" style="margin-bottom:10px">
                    <div class="col-lg-7" style="text-align:left;">
                        <h3> Thông tin người nhận</h3>
                        <h5>{{ $order->email }}</h5>
                        <h5>{{ $order->username}}</h5>
                        <p>{{ $order->address}}</p>
                        <p>{{ $order->phone}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h5>Tình trạng đơn hàng</h5>
                    </div>
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