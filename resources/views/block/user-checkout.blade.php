@extends('main')

@section('content')

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                @include('block.alert')
                <form method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6" >
                            <h6 class="checkout__title">Thanh toán</h6>
                            <div class="checkout__input">
                                <p>Họ tên<span>*</span></p>
                                <input type="text" name="user_name" value="{{ $account->profile->name}}">
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" name="email" value="{{ $account->email}}">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ..." class="checkout__input__add" name="address" value="{{ $account->profile->address}}">
                            </div>
                            @include('block.cd')
                            <div class="form-group">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="number" value="0{{ $account->profile->phone}}" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Chi tiết đơn hàng</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                                <input type="hidden" name="cart_id" value="{{ $cartid->id }}">
                                <ul class="checkout__total__products">
                                    @php $total = 0 @endphp
                                    @foreach($carts as $key => $cart)
                                        @foreach($cart->cart_items as $item)
                                            @php $total += $item['price'] * $item['quantity']  @endphp
                                            <li style="font-weight:bold;'" class="row">
                                                <span class="col-lg-8">x{{ $item['quantity'] }} {{ $item['name'] }} đ</span>
                                                <span class="col-lg-4">{{ number_format($item['price'] * $item['quantity'],0,',','.')}} đ</span>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Tạm tính <span>{{ number_format($total,0,',','.')}} đ</span></li>
                                    <li id="Sales">Giảm giá
                                        <span id="discount">{{$voucher->voucher}}</span>
                                    </li>
                                    @php $maintotal = $total - $voucher->voucher @endphp
                                    <li>Tiền vận chuyển <span>0</span></li>
                                    <li>Tổng tiền<span>{{ number_format($maintotal,0,',','.')}} đ</span></li>
                                    <input type="hidden" name="total" value="{{ $maintotal }}">
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