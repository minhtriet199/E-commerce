<!DOCTYPE html>
<html lang="en">
<head>
	@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    @include('block.head')
</head>

<body > 
	@include('sweetalert::alert')
	@include('block.header')
	<button id="btnScrolltop" class="btn-top" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
	
	@yield('content')

	@include('block.footer')

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$(window).scroll(function(){
			if($(this).scrollTop() > 40){
				$('.btn-top').show(); //not working
			} else{
				$('.btn-top').show();
			}
		}).trigger('scroll');
	});
</script>