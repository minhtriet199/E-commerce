
<button  onclick="autoTop()" id="btnScrolltop" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
	
<!DOCTYPE html>
<html lang="en">
<head>
	@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    @include('block.head')
</head>

<body > 
	@include('sweetalert::alert')
	@include('block.header')
	<button  onclick="autoTop()" id="btnScrolltop" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
	
	@yield('content')

	@include('block.footer')

</body>
</html>

