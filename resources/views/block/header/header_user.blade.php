<li>
    <a href=" {{ url('user/account/profile') }} "><i class="fa fa-solid fa-user"></i></a>
    <ul class="dropdown" style="color:white; text-align:center;">
        <li><a href="{{ url('/user/account/profile/')}}">Tài khoản của tôi</a></li>
        <li ><a href="{{ url('user/logouts') }}">Đăng xuất</a></li>
    </ul>
</li>