
<!DOCTYPE html>
<html lang="en">
<head>
	@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    @include('block.head')
</head>

<body > 

	<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
	
	@if(Auth::check()) @include('block.Userheader')
	@else @include('block.header')
	@endif

	
	@yield('content')

	@include('block.footer')

</body>
</html>