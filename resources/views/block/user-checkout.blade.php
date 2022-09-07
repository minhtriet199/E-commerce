@extends('main')

@section('content')

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6" >
                            <h6 class="checkout__title">Thanh toán</h6>
                            <div class="checkout__input">
                                <p>Họ tên<span>*</span></p>
                                <input type="text" value="{{ $users->profile->name}}">
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" value="{{ $users->email}}">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ..." class="checkout__input__add" value="{{ $users->profile->address}}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Thành phố<span>*</span></p>
                                        <select name="city" id="city" class="custom-select rounded-0 choose city">
                                            <option value="0"> {{ $users->profile->city}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Quận<span>*</span></p>
                                        <select  name="district_id" id="district" class="custom-select rounded-0 district">
                                            <option value="0"> {{ $users->profile->district}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="text" value="0{{ $users->profile->phone}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Chi tiết đơn hàng</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                                <ul class="checkout__total__products">
                                    @php $total = 0 @endphp
                                    @foreach(session('carts') as $product_id => $details)
                                        <li style="font-weight:bold;'" class="row">
                                            <span class="col-lg-8">x{{ $details['quantity'] }} {{ $details['name'] }}</span>
                                            <span class="col-lg-4">{!! \App\Helpers\Helper::currency_format($details['price'] * $details['quantity']) !!}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Tạm tính <span>{!! \App\Helpers\Helper::currency_format($details['price'] * $details['quantity']) !!}</span></li>
                                    <li>Tổng tiền <span>{!! \App\Helpers\Helper::currency_format($details['price'] * $details['quantity']) !!}</span></li>
                                </ul>
                                <button type="submit" class="site-btn">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection