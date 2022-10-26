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
                                    <input type="hidden" class="voucher" value="{!! old('discount') !!}" name="voucher">
                                    <li>Tạm tính <span>{{ number_format($total,0,',','.')}} đ</span></li>
                                    <li>Giảm giá <span class="discount"> 0 đ</span></li>
                                    <li>Tiền vận chuyển <span class="fee"> 0</span> </li>
                                    <li>Tổng tiền <span> đ </span> <span class="grand-total"> {{ number_format($total,0,',','.')}}  </span></li>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){

        const token = $('meta[name="csrf-token"]').attr('content');
        const gtotal = $('.grand-total').text();
        const grand_total = parseInt(gtotal);
        
        function fetch_voucher(){
            const voucher =$('.voucher').val();
            if(voucher != ''){
                $.ajax({
                        type: 'post',
                        url:'/use_voucher',
                        data:{
                            voucher:voucher,
                            token:token,
                        },
                    success: function(response){
                        if(response.error == true){
                            const total = (grand_total*1000) - parseInt(response.discount);
                            $('.discount').html(response.discount + ' đ');
                            $('.grand-total').html(total);
                        }
                    }
                });
            }      
        }
       
           
        function fetch_delivery(){
           const district = $('.district').val();

            if(district != ''){
                $.ajax({
                    type: 'post',
                    url:'/delivery_price',
                    data:{
                        district:district,
                        token:token,
                    },
                    success: function(response){
                        if(response.error == true){
                            const total = grand_total * 1000 + parseInt(response.fee);
                            $('.fee').html(response.fee + ' đ');
                            $('.grand-total').text(total);
                        }
                        if(response.error == false){
                            const total = grand_total * 1000 + 40000;
                            $('.fee').html(response.fee + ' đ');
                            $('.grand-total').text(total);
                        }
                    }
                });
            }
        }
        $('.district').change(function(e){
            e.preventDefault();
            fetch_delivery();
        });
        $.when( fetch_voucher() ).done(function() {
            fetch_delivery();
        });
    });
</script>