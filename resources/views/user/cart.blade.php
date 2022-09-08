@extends('main')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Cửa hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="/">Cửa hàng</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table id="table-product">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="price">
                            @php $total =0 @endphp
                            @foreach($carts as $key => $cart)
                                
                                @foreach($cart->cart_items as $cart)
                                @php $total += $cart->price * $cart->quantity  @endphp
                                <tr data-id="{{ $cart->product_id }}" id="product{{ $cart->product_id }}" >
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ $cart->thumb }}" width="80px">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6 style="padding-top:10px;">{{ $cart->name }}</h6>
                                            <h5>{!! \App\Helpers\Helper::currency_format($cart->price) !!} </h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2" data-th="Quantity">
                                                <input type="number" value="{{ $cart->quantity }}" class="quantity quantity-btn" name="product_qty" > 
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price" > {!! \App\Helpers\Helper::currency_format($cart->price * $cart->quantity) !!} </td>
                                    <td class="cart__close"><button class="remove-from-cart" style="border-radius:45px"><i class="fa fa-close"></i></button></td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Mã giảm giá</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Xác nhận</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Tổng tiền</h6>
                    <ul id="cast">
                        <li>Tạm tính <span>{!! \App\Helpers\Helper::currency_format($total) !!}</span></li>
                        <li>Tổng tiền<span>{!! \App\Helpers\Helper::currency_format($total) !!}</span></li>
                    </ul>
                    <a href="{{ url('/checkout') }}" class="primary-btn">THANH TOÁN</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection