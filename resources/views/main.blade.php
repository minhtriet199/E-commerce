
<button  onclick="autoTop()" id="btnScrolltop" class="btnScrolltop" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
	
<!DOCTYPE html>
<html lang="en">
<head>
	@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    @include('block.head')
</head>

<body > 

	@if(Auth::check()) @include('block.Userheader')
	@else @include('block.header')
	@endif

	
	@yield('content')

	@include('block.footer')

</body>
</html>