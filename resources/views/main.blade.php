<!DOCTYPE html>
<html lang="en">
<head>
	@php $menusHtml = Helper::menus($menus); @endphp
    @include('block.head')
</head>

<body > 
	@include('sweetalert::alert')
	@include('block.header')
	<!-- Check ViewServiceProvider for more info -->
	<button class="btn-top btnScrolltop" id="btntop" title="Go to top">
		<i class="fa fa-angle-double-up"></i>
	</button>
	
	<div class="body">
		@yield('content')
	</div>

	@include('block.footer')

</body>
</html>