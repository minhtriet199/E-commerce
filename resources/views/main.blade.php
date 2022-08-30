
<!DOCTYPE html>
<html lang="en">
<head>
@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    @include('block.head')
</head>

<body > 

	@include('block.header')

	
	@yield('content')

	@include('block.footer')

</body>
</html>