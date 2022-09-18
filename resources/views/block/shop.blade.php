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
                                                <a href="{{ url('/shop')}}">Tất cả</a>
                                                {!! \App\Helpers\Helper::menus($menus) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Tầm giá</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a href="#">0 Đ - 100.000 Đ</a></li>
                                                    <li><a href="#">101.000Đ - 200.000 Đ</a></li>
                                                    <li><a href="#">201.000 Đ - 300.00 Đ</a></li>
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
                                         <select onchange="location = this.value;">
                                            <option value="{{ request() -> url() }}">Mặc định</option>
                                            <option value="{{ request() -> fullUrlWithQuery(['price' => 'asc']) }}">Thấp đến cao</option>
                                            <option value="{{ request() -> fullUrlWithQuery(['price' => 'desc']) }}" >Cao đến thấp</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                {!! \App\Helpers\Helper::product($product,$product->price,$product->price_sale) !!}
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop