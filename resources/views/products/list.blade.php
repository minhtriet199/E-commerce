
<div class="row product__filter">
    @foreach($products as $product)
    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
        <div class="product__item">
            <a href="/product/{{$product->slug}}">
                <div class="product__item__pic set-bg" data-setbg="{{$product->thumb}}" style="background-image: url('{{$product->thumb}} ')">
                    <ul class="product__hover">
                        <span class="label" class="product__hover"><h6>{{$product -> name}}</h6></span>
                    </ul>
                </div>
            </a>
            <div class="product__item__text">
                <h6>{{$product -> name}}</h6>
                <a href="/product/{{$product->slug}}" class="add-cart">+ Xem chi tiết</a>
                {!! \App\Helpers\Helper::price($product,$product->price,$product->price_sale) !!}
            </div>
        </div>
    </div>
    @endforeach
</div>
