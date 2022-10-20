@extends('main')

@section('content')
   
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
            @include('block.alert')
                <form method="POST">
                    <div class="row">
                        <div class="col-lg-8 col-md-6" >
                            <h6 class="checkout__title">Thanh toán</h6>
                            <div class="checkout__input">
                                <p>Họ tên<span>*</span></p>
                                <input type="text" value="" name="user_name" >
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" value="" name="email">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ..." class="checkout__input__add"  name="address"value="">
                            </div>
                            @include('block.cd')
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="number" value="0" name="phone">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Chi tiết đơn hàng</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                                <ul class="checkout__total__products">
                                    @php $total = 0 @endphp
                                    @foreach(session('carts') as $product_id => $details)
                                        @php $total += $details['price'] * $details['quantity']  @endphp
                                        <li style="font-weight:bold;'" class="row">
                                            <span class="col-lg-8">x{{ $details['quantity'] }} {{ $details['name'] }}</span>
                                            <span class="col-lg-4">{{ number_format($details['price'] * $details['quantity'],0,',','.')}} đ</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Tạm tính <span>{{ number_format($total,0,',','.')}} đ</span></li>
                                    <li>Tổng tiền <span>{{ number_format($total,0,',','.')}} đ</span></li>
                                    <input type="hidden" name="total" value="{{ $total }}">
                                </ul>
                                <button type="submit" class="site-btn">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </section>
@endsection