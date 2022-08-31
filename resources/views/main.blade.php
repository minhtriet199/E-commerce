
<!DOCTYPE html>
<html lang="en">
<head>
@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    @include('block.head')
</head>

<body > 

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up"></i></button>

	@include('block.header')

	
	@yield('content')

	@include('block.footer')

</body>
</html>