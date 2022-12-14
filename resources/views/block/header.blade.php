<header class="header">
    
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="/"><img src="/assets/img/logo.png" width="150px" ></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li><a href="{{ url('/shop/all')}}">Cửa hàng</a>
                            <ul class="dropdown">
                                <li>
                                    {!! $menusHtml !!}
                                </li>
                            </ul>
                        </li>
                        <li><a href="http://m.me//triet19/" target="_blank">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__menu mobile-menu">
                    <ul>
                        @if(Auth::check())
                            @include('block.header.header_user')
                        @else
                            @include('block.header.header_session')
                        @endif
                        <li><a href="{{ url('/wishlist') }}"> <i class="fa fa-heart"></i> </a></li>

                        <li><a  class="search-switch"><i class="fa fa-search"></i></a>
                            <ul class="dropdown" style="background:none">
                                <li>
                                    <input type="text" name="search-box" placeholder="Tìm kiếm" class="header-search-box" id="search-box" autocomplete="off">
                                </li>
                                <div id="search-result">
                                </div>
                            </ul>
                        </li>
                        <li>
                            <a href="/view-cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span class='badge badge-warning CartCount display'>{!! Helper::countCart() !!}</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>


<script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
<script type="text/javascript">

    var notificationCount = $('.CartCount').text();
    var notifyCount = parseInt(notificationCount);
    var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        cluster: 'ap1',
        encrypted: true
    });
    var channel = pusher.subscribe('AddCart');

    channel.bind('addCart', function(data) {
        var amount = parseInt(data.amount);
        notifyCount += amount;
        $('.display').text(notifyCount);
    });
    
    channel.bind('decreasedCart',function(data){
        var amount = parseInt(data.amount);
        notifyCount += amount;
        $('.display').text(notifyCount);
    });
    
</script>
