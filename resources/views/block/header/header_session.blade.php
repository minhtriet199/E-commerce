
<ul>
    <li><a href=" {{ url('user/login') }} "><i class="fa fa-solid fa-user"></i></a></li>
    <li><a href="#" class="search-switch"><i class="fa fa-search"></i></a>
        <ul class="dropdown" style="background:none">
            <li>
                <input type="text" name="search-box" placeholder="Tìm kiếm" class="header-search-box" id="search-box" autocomplete="off">
            </li>
            <div id="search-result">
            </div>
        </ul>
    </li>
    <li><a href="{{url('/view-cart')}}"><i class="fa fa-shopping-cart"></i></a></li>
</ul>