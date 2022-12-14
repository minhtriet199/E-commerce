<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thông tin đơn hàng {{ $order -> id}}</title>
</head>
<body>
    <section>
        <div class="container" style="width:100%;display:flex;justify-content: center;">
            <div class="mid-table finish" style="padding:10px 20px;border:1px solid black;">
                <h4><i class="fa fa-check" style="color:#55FF2E;margin-bottom:50px;"></i> Mã đơn hàng của bạn là: <span>{{ $order -> id}}</span></h4>
                <div class="user_info">
                    <div  style="text-align:left; margin-bottom:20px;" >
                        <div class="row" style="display:flex;">
                            <h4> Xin chào {{ $order ->username}} </h4>
                        </div>
                        Tình trạng đơn hàng:<h5> {!! \App\Helpers\Helper::orderStatus($order->status) !!}</h5>
                        <h5><strong>{{ $order->email }}</strong></h5>
                        <h6>{{ $order->address}}</h6>
                        <h6>0{{ $order->phone}}</h6>
                        <h4>Tổng tiền: {{number_format($order->total,0,',',',')}} đ</h4>
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
                            @foreach($order->order_details as $detail)
                                <tr>
                                    <td> <img src=" {{ $detail -> thumb}}" style="width:100px"></td>
                                    <td>{{ $detail -> product_name }}</td>
                                    <td>{{ $detail -> quantity}}</td>
                                    <td>{{ number_format($detail -> price,0,',',',')}} đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>