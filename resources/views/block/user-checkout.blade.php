@extends('main')

@section('content')

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                @include('user.alert')
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6" >
                            <h6 class="checkout__title">Thanh toán</h6>
                            <div class="checkout__input">
                                <p>Họ tên<span>*</span></p>
                                <input type="text" name="user_name" value="{{ $users->profile->name}}">
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" name="email" value="{{ $users->email}}">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ..." class="checkout__input__add" name="address" value="{{ $users->profile->address}}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Thành phố<span>*</span></p>
                                        <select name="city" id="city" class="custom-select rounded-0 choose city">
                                            <option value="{{ $users->profile->city}}"> {{ $users->profile->city}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Quận<span>*</span></p>
                                        <select  name="district_id" id="district" class="custom-select rounded-0 district">
                                            <option value="{{ $users->profile->district}}"> {{ $users->profile->district}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="text" value="0{{ $users->profile->phone}}" name="phone">
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
                                                    <span class="col-lg-8">x{{ $item['quantity'] }} {{ $item['name'] }}</span>
                                                    <span class="col-lg-4">{!! \App\Helpers\Helper::currency_format($item['price'] * $item['quantity']) !!}</span>
                                                </li>
                                            @endforeach
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Tạm tính <span>{!! \App\Helpers\Helper::currency_format($total) !!}</span></li>
                                    
                                    <li>Tiền vận chuyển <span>0</span></li>
                                    <li>Tổng tiền <span>{!! \App\Helpers\Helper::currency_format($total) !!}</span></li>
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