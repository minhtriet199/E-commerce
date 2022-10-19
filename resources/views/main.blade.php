<!DOCTYPE html>
<html lang="en">
<head>
	@php $menusHtml = Helper::menus($menus); @endphp
    @include('block.head')
</head>

<body > 
	@include('sweetalert::alert')
	@include('block.header')
	<button class="btn-top btnScrolltop" id="btntop" title="Go to top">
		<i class="fa fa-angle-double-up"></i>
	</button>
	
	<div class="body">
		@yield('content')
	</div>

	@include('block.footer')

</body>
</html>
<!-- <script type="text/javascript">

$(document).ready(function(){
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
			  $('#btntop').show();
        } else {
            $('#btntop').hide();
        }
    });
});

</script> -->