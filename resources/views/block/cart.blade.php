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
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="img/shopping-cart/cart-2.jpg" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>Diagonal Textured Cap</h6>
                                        <h5>$98.49</h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2">
                                            <input type="number" value="1" class="quanity-btn" name="product-qty">
                                        </div>
                                        <input type="hidden" value="7" name="id">
                                    </div>
                                </td>
                                <td class="cart__price">$ 32.50</td>
                                <td class="cart__close"><i class="fa fa-close"></i></td>
                            </tr>
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
                    <ul>
                        <li>Tạm tính <span>$ 169.50</span></li>
                        <li>Tổng tiền<span>$ 169.50</span></li>
                    </ul>
                    <a href="#" class="primary-btn">THANH TOÁN</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection