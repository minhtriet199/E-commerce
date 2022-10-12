<!DOCTYPE html>
<html lang="en">
<head>
	@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    @include('block.head')
</head>

<body > 
	@include('sweetalert::alert')
	@include('block.header')
	<button class="btn-top btnScrolltop" title="Go to top">
		<i class="fa fa-angle-double-up"></i>
	</button>
	
	<div class="body">
		@yield('content')
	</div>

	@include('block.footer')

</body>
</html>