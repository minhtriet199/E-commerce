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
                            @if(session('carts'))
                                @foreach(session('carts') as $product_id => $details)
                                    @php $total += $details['price'] * $details['quantity']  @endphp
                                    <tr data-id="{{ $product_id }}" id="product{{ $product_id }}" >
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="{{ $details['thumb'] }}" width="80px">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6 style="padding-top:10px;">{{ $details['name'] }}</h6>
                                                <h5>{{ number_format($details['price'],0,',','.') }} đ </h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2" data-th="Quantity">
                                                    <input type="number" value="{{ $details['quantity'] }}" class="quantity quantity-btn" name="product_qty" > 
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price" > {{ number_format($details['price'] * $details['quantity'],0,',','.')}} đ </td>
                                        <td class="cart__close"><button class="remove-from-cart" style="border-radius:45px"><i class="fa fa-close"></i></button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Mã giảm giá</h6>
                        <form>
                            <input type="text" name="voucher_code" placeholder="Coupon code">
                            <button type="button" id="voucher-btn">Xác nhận</button>
                            @csrf
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Tổng tiền</h6>
                        <ul id="cast">
                            <li>Tạm tính <span>{{ number_format($total,0,',','.')}} đ</span></li>
                            <li id="Sales">Giảm giá <span></span></li>
                            <li>Tổng tiền<span>{{ number_format($total,0,',','.')}} đ</span></li>
                        </ul>
                        <a href="{{ url('/checkout') }}" class="primary-btn">THANH TOÁN</a>
                </div>
            </div>
        </div>
    </div>
</section>