<div class="row product__filter">
    @foreach($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix">
            {!! Helper::product($product) !!}
        </div>
    @endforeach
</div>
