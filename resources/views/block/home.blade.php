@extends('main')

@section('content')
	<section class="hero">
	<div class="hero__slider owl-carousel">
		@foreach($sliders as $slider)
			<div class="hero__items set-bg" data-setbg="{{ $slider -> thumb }}">
				<div class="container">
					<div class="row">
						<div class="col-xl-5 col-lg-7 col-md-8">
							<div class="hero__text">
								<h1>{{ $slider -> name }}</h1>
								<a href="/shop" class="primary-btn">Mua hàng <span class="arrow_right"></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
	</section>
	<!-- Banner Section Begin -->
	<section class="banner spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 offset-lg-4">
					<div class="banner__item">
						<div class="banner__item__pic">
							<img src="/assets/img/banner/banner-1.jpg" alt="">
						</div>
						<div class="banner__item__text">
							<h2>Áo</h2>
							<a href="#">Ghé Shop</a>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="banner__item banner__item--middle">
						<div class="banner__item__pic">
							<img src="/assets/img/banner/banner-2.jpg" alt="">
						</div>
						<div class="banner__item__text">
							<h2>Áo khoác</h2>
							<a href="#">Ghé Shop</a>
						</div>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="banner__item banner__item--last">
						<div class="banner__item__pic">
							<img src="/assets/img/banner/banner-3.jpg" alt="">
						</div>
						<div class="banner__item__text">
							<h2>Quần</h2>
							<a href="#">Ghé Shop</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Banner Section End -->

	<!-- Product Section Begin -->
	<section class="product spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="filter__controls">
						<li class="active" data-filter="*">Bán chạy</li>
						<li data-filter=".new-arrivals">Mới nhất</li>
						<li data-filter=".hot-sales">Giảm giá</li>
					</ul>
				</div>
			</div>
			<div id="loadProduct">
				@include('products.list')	
			</div>
				
			
			<div class="row button-more " id="btn-loadmore">
				<input type="hidden" value="1" id="page">
				<a onclick="loadMore()"> Xem thêm</a>
			</div>
		</div>
	</section>
@stop