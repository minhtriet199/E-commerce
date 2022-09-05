@extends('main')

@section('content')
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{url('/shop')}}">Cửa hàng</a>
                            <a href="/shop/{{$products->menus->slug}}.html">{{ $products->menus->name}}</a>
                            <span>{{ $products -> name}}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <!-- list ảnh chưa làm-->
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ $products -> thumb}}">
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ $products -> thumb}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $products -> name}}</h4>

                            {!! \App\Helpers\Helper::priceDetail($products,$products->price,$products->price_sale) !!}

                            <p>{{ $products -> description }}</p>
                            
                            <!-- Chưa làm-->
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <label for="xxl">xxl
                                        <input type="radio" id="xxl">
                                    </label>
                                    <label class="active" for="xl">xl
                                        <input type="radio" id="xl">
                                    </label>
                                    <label for="l">l
                                        <input type="radio" id="l">
                                    </label>
                                    <label for="sm">s
                                        <input type="radio" id="sm">
                                    </label>
                                </div>
                            </div>

                            <div class="product__details__cart__option">
                                <form action="/add-cart" method="POST">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="number" value="1" class="quanity-btn" name="product_quantity">
                                        </div>
                                        <input type="hidden" value="{{ $products -> id}}" name="product_id">
                                        <input type="hidden" value="{{ $products -> name}}" name="product_name">
                                        {!! \App\Helpers\Helper::formprice($products,$products->price,$products->price_sale) !!}
                                    </div>
                                    <input type="button" class="primary-btn" value="Thêm vào giỏ hàng" id="btn-cart">
                                    @csrf
                                </form>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> Thêm vào danh sách ước</a>
                            </div>
                            <div class="product__details__last__option">
                                <img src="/assets/img/shop-details/details-payment.png" alt="">
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Bản số đo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Bình luận</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content" style="text-align:center">
                                        {!! html_entity_decode($products ->content) !!}
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Có thể bạn quan tâm</h3>
                </div>
            </div>
            <div class="row">
            @foreach($more as $more)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <a href="/product/{{$more ->slug}}.html">
                            <div class="product__item__pic set-bg" data-setbg="{{$more ->thumb}}" style="background-image: url('{{$more ->thumb}} ')">
                                <ul class="product__hover">
                                    <span class="label" class="product__hover"><h6>{{$more -> name}}</h6></span>
                                </ul>
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h6>{{$more -> name}}</h6>
                            <a href="#" class="add-cart">+ Thêm vào giỏ hàng</a>
                            {!! \App\Helpers\Helper::price($more ,$more ->price,$more ->price_sale) !!}
                        </div>
                    </div>
                </div>
            @endforeach
                
            </div>
        </div>
    </section>
@endsection
