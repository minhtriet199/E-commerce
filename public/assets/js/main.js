/*  ---------------------------------------------------
    Template Name: Male Fashion
    Description: Male Fashion - ecommerce teplate
    Author: Colorib
    Author URI: https://www.colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.product__filter').length > 0) {
            var containerEl = document.querySelector('.product__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*-----------------------
        Hero Slider
    ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false
    });

    /*--------------------------
        Select
    ----------------------------*/
   

    /*-------------------
		Radio Btn
	--------------------- */
    $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").on('click', function () {
        $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------
		Scroll
	--------------------- */
    $(".nice-scroll").niceScroll({
        cursorcolor: "#0d0d0d",
        cursorwidth: "5px",
        background: "#e5e5e5",
        cursorborder: "",
        autohidemode: true,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end


    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"));
    });

    /*------------------
		Magnific
	--------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="fa fa-angle-up dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-down inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('dec')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });
    
    var proQty = $('.pro-qty-2');
    proQty.append('<span class="fa fa-angle-down inc qtybtn"></span>');
    proQty.prepend('<span class="fa fa-angle-up dec qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('dec')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });
    
    /*------------------
        Achieve Counter
    --------------------*/
    $('.cn_num').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

})(jQuery);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function loadMore(){
    const page= $('#page').val();
    var trang=parseInt(page);
    $.ajax({
        type:'POST',
        datatype:'JSON',
        data: {page},
        url: '/services/load-product',
        success: function(result){
            if(result.html !== ''){
                $('#loadProduct').append(result.html);
                $('#page').val(trang+1);
            }
            else{
                $('#btn-loadmore').css('display','none');
            }
        }
    })
}

function autoTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}




$(document).ready(function() {
    //update user ajax
    $('#btn-update-user').click(function(e){
        const user_id =$('input[name="user_id"]').val();
        const name = $('input[name="name"]').val();
        const phone =$('input[name="phone"]').val();
        const address =$('input[name="address"]').val();
        const city =$('#city :selected').text();
        const district =$('#district :selected').text();

        $.ajax({
            type: 'POST',
            dataType:'JSON',
            url:'profile/update',
            data:{
                user_id:user_id,
                name:name,
                phone:phone,
                address:address,
                city:city,
                district,district,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                if(response.error !==false){
                    $('#user-alert').html("Cập nhật thành công");
                    $('#user-alert').css('color','green')
                }
                else{
                    $('#user-alert').html("Cập nhật Thất bại");
                    $('#user-alert').css('color','red')
                }
            }
        });
    });

   
});


$(document).ready(function() {

    //them gio hang ajax
    $('#btn-cart').click(function(e){
        const product_id = $('input[name="product_id"]').val();
        const product_name = $('input[name="product_name"]').val();
        const product_price = $('input[name="product_price"]').val();
        const product_quantity = $('input[name="product_quantity"]').val();
        const product_thumb = $('input[name="product_thumb"]').val();
        $.ajax({
            type:'POST',
            dataType:'JSON',
            url:'/add-cart',
            data:{
                product_id : product_id,
                product_price:product_price,
                product_quantity:product_quantity,
                product_name:product_name,
                product_thumb:product_thumb,
            },
            success:function(data){
                Swal.fire({
                    type: 'success',
                    title: 'Thêm giỏ hàng thành công',
                });
            }

        });
    });

});

$(document).ready(function(){
    
    $(".quantity-btn").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        const qty = $('input[name="product_qty"]').val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: '/update-cart',
            method: "patch",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), 
                id: ele.parents("tr").attr("data-id"), 
                quantity: qty,
                _token:_token,
            },
            success: function (response) {
               window.location.reload();
                $("#cast").load(location.href + " #cast");
            }
        });
    });

    $(".u-quantity-btn").change(function (e) {
        const qty = $('input[name="product_quantity"]').val();

        $.ajax({
            url: 'update-carts',
            method: 'patch',
            dataType:'JSON',
            data: {
                id: $(this).parents("tr").attr("data-id"), 
                quantity: qty,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data) {
                location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        var id = ele.parents("tr").attr("data-id");
        $.ajax({
            url: '/remove-cart',
            method: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), 
                id: id, 
            },
            success: function (response) {
                $('#product'+id).remove();
                $("#cast").load(location.href + " #cast");
            }
        });
    });

    $(".u-remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        var id = ele.parents("tr").attr("data-id");
        $.ajax({
            url: 'destroy',
            method: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), 
                id: id, 
            },
            success: function (response) {
                $('#product'+id).remove();
                $("#cast").load(location.href + " #cast");
            }
        });
    });
    
    $('.choose').change(function(){
        var action = $(this).attr('id');
        var city_id = $(this).val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var result = '';

        if(action == 'city') {
            result='district';
        }

        $.ajax({
            url: '/select-delivery' ,
            method: 'POST',
            data:{
                action:action,
                city_id:city_id,
                _token:_token
            },
            success:function(data){
                $('#district').html(data);
            }
        });
   });
   
   $('#voucher-btn').click(function(e){
        e.preventDefault();
        const voucher_code = $('input[name="voucher_code"]').val();
        const _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/use-voucher',
            method: 'get',
            dataType:'json',
            data: {
                _token:_token,
                voucher_code:voucher_code,
            },
            success: function(data){
            }
        })

   });
   
    
   $('#btn-comment').click(function(e){
        const user_id=$('input[name="user_id"]').val();
        const product_id =$('input[name="product_id"]').val();
        const content = $('#content').val();
        const token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            dataType:'JSON',
            url:'/user/comment',
            data:{
                user_id:user_id,
                product_id:product_id,
                content:content,
                token:token,
            },
            success:function(data){
                fetchcmt();
            }
        });
    });

    $('#search-box').keyup(function(){
        const search = $('input[name="search-box"]').val();
        $.ajax({
            type: 'get',
            dataType: 'JSON',
            url:'/search',
            data:{
                search:search,
            },
            success:function(data){
                console.log(data);
                $('#search-result').html(data.result);
            }
        })
    });

    

});

function fetchcmt(){
    const product_id = $('#product_id').val();
    $.ajax({
        type: 'get',
        url: '/fetchcmt/',
        data:{product_id:product_id},
        success: function(data) {
            $('#comment-section').html(data.result);
        },
    });
}
fetchcmt();