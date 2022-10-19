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

                            {!! Helper::priceDetail($products,$products->price,$products->price_sale) !!}
                            <a class="btn text-danger add-wishlist">
                                <i class="fa fa-heart "></i> 
                                Thêm vào danh sách ước
                            </a>
                            <p>{{ $products -> description }}</p>
                            
                            <div class="product__details__cart__option">
                               
                                <form action="/add-cart" method="POST">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="number" value="1" class="quanity-btn" name="product_quantity">
                                        </div>
                                        <input type="hidden" value="{{ $products -> id}}" name="product_id" id="product_id">
                                        <input type="hidden" value="{{ $products -> name}}" name="product_name">
                                        <input type="hidden" value="{{ $products -> thumb}}" name="product_thumb">
                                        {!! Helper::formprice($products,$products->price,$products->price_sale) !!}
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
                                        <div id="comment-section">
                                        <!-- Using Fetchcomment at the bottom page-->
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
                    {!! \App\Helpers\Helper::product($more,$more->price,$more->price_sale) !!}
                </div>
            @endforeach
                
            </div>
        </div>
    </section>
    <!-- Related Section End -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        function fetchcmt(){
            const product_id = $('#product_id').val();
            $.ajax({
                type: 'get',
                url: '/fetchcmt/',
                data:{product_id:product_id},
                success: function(data) {
                    $('#comment-section').html(data.result);
                },
            });
        }
        fetchcmt();

        $('#btn-comment').click(function(e){
            const user_id=$('input[name="user_id"]').val();
            const product_id =$('input[name="product_id"]').val();
            const content = $('#content').val();
            const token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                dataType:'JSON',
                url:'/user/comment',
                data:{
                    user_id:user_id,
                    product_id:product_id,
                    content:content,
                    token:token,
                },
                success:function(data){
                    fetchcmt();
                }
            });
        });

      
    });
</script>