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
                   @if(Auth::check())
                        @include('block.header.header_user')
                    @else
                        @include('block.header.header_session')
                    @endif
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
    
<img src="" alt="">