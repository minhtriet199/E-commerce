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
                        <li><a href="{{ url('/shop')}}">Cửa hàng</a>
                            <ul class="dropdown">
                                <li>
                                    {!! $menusHtml !!}
                                </li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Giới thiệu</a></li>
                        <li><a href="./contact.html">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__menu mobile-menu">
                    <ul>
                        <li><a href=" {{ url('user/login') }} "><i class="fa fa-solid fa-user"></i></a></li>
                        <li><a href="#" class="search-switch"><i class="fa fa-search"></i></a></li>
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        <li><a href="{{url('/view-cart')}}"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
    