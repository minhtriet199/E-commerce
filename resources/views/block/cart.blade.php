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
    @php $total = 0 @endphp
    @if(Auth::check())
        @include('cart.cart_user')
    @else
        @include('cart.cart_session')
    @endif
@endsection
