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
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseSix">Danh mục</a>
                                    </div>
                                    <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__tags">
                                                <ul>
                                                    <li><a href="{{ url('/shop/all')}}">Tất cả</a></li>
                                                    {!! Helper::menus($menus) !!}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sắp xếp theo:</p>
                                         <select class="orderby-price">
                                            <option value="0">Mặc định</option>
                                            <option value="asc">Thấp đến cao</option>
                                            <option value="desc" >Cao đến thấp</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="product-tab">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                {!! Helper::product($product) !!}
                            </div>
                        @endforeach
                    </div>
                    <div class="row" id="product-by-price">

                    </div>
                    <div class="row" id="paginate">
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

