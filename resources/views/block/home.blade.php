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

	<!-- Product Section Begin -->
	<section class="product spad main-home">
		<div class="container">

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