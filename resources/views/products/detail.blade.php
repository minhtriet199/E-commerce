@extends('main')

@section('content')
  
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{url('/shop')}}">Cửa hàng</a>
                            <a href="/shop/{{$products->menus->slug}}">{{ $products->menus->name}}</a>
                            <span>{{ $products -> name}}  </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <!-- list ảnh chưa làm-->
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ $products -> thumb}}">
                                    </div>    
                                </a>
                            </li>
                            @php $tab = 1 @endphp
                            @foreach($products->product_image as $product_images)
                                @php $tab += 1 @endphp
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-{{ $tab }}" role="tab" aria-selected="false">
                                        <div class="product__thumb__pic set-bg" data-setbg="{{ $product_images -> image}}">
                                        </div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ $products -> thumb}}" alt="">
                                </div>
                            </div>
                            @php $tabpanel = 1 @endphp
                            @foreach($products->product_image as $product_images)
                                @php $tabpanel += 1 @endphp
                                <div class="tab-pane" id="tabs-{{ $tabpanel }}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{ $product_images -> image}}" alt="">
                                    </div>
                                </div>
                            @endforeach
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

                            {!! Helper::priceDetail($products) !!}
                            <a class="btn text-danger add-wishlist">
                                <i class="fa fa-heart "></i> 
                                Thêm vào danh sách ước
                            </a>
                            <p>{{ $products -> description }}</p>
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
                            <div class="product__details__cart__option">
                               
                                <p class="text-danger">{!! Helper::check_product($products->amount) !!}</p>
                                <form action="" method="POST">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="number" value="1" class="quanity-btn" name="product_quantity" >
                                        </div>
                                        <input type="hidden" value="{{ $products -> id}}" name="product_id" id="product_id">
                                        <input type="hidden" value="{{ $products -> name}}" name="product_name">
                                        <input type="hidden" value="{{ $products -> thumb}}" name="product_thumb">
                                        {!! Helper::formprice($products) !!}
                                    </div>
                                    @if($products->amount <= 0 )
                                        <input type="button" class="primary-btn" value="Hết hàng">
                                    @else
                                        <input type="button" class="primary-btn" value="Thêm vào giỏ hàng" id="btn-cart">
                                    @endif
                                    @csrf
                                </form>
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
                                        <!-- Use this to convert HTML -->
                                        {!! html_entity_decode($products ->content) !!}
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    @if(Auth::check())
                                        <div style="width:100%;text-align:center;padding-top:50px;">
                                            <!-- Comment Ajax at the bottom page -->
                                            <form action="">
                                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                                <textarea name="content" id="content" cols="30" rows="5" style="width:100%;padding:20px" placeholder="Nhập comment"></textarea>
                                                <input type="button" value="Bình luận" class="primary-btn btn-comment" id="btn-comment">
                                                @csrf
                                            </form>
                                        </div>
                                    @else
                                        <div style="width:100%;text-align:center;padding-top:50px;">
                                            <a href="{{ url('user/login') }}" class="primary-btn">
                                                Đăng nhập
                                            </a>
                                        </div>
                                    @endif
                                    <div id="comment">
                                        <div id="user-comment">

                                        </div>
                                        <div id="comment-section">
                                        <!-- Using Fetchcomment at the bottom page-->
                                            @foreach($comments as $comment)
                                                <div class="product__details__tab__content">
                                                    <div class="row">
                                                        <div class="col-lg-1">
                                                            <img src="/assets/img/user.png" >
                                                        </div>
                                                        <div class="col-lg-11">
                                                            <div><span class="user_name"> {{ $comment->name }} </span> 
                                                                {!! \Carbon\Carbon::parse($comment->updated_at)->diffForHumans() !!}
                                                            <div>
                                                                {{ $comment->Content }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
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
                    {!! Helper::product($more,$more->price,$more->price_sale) !!}
                </div>
            @endforeach
                
            </div>
        </div>
    </section>
    <!-- Related Section End -->
@endsection
