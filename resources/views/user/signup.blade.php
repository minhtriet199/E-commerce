@extends('main')

@section('content')

<section>
    <div class="container">
        <div class="mid-table">
            <form id="validate-signup" method="POST" >
                <h2>Đăng ký</h2>
                @include('block.alert')
                <input type="text" name="name" placeholder="Họ và tên" id="input-formu" value="{!! old('name') !!}">
                <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email" id="input-formu" value="{!! old('email') !!}">
                <input type="password" name="password" placeholder="Mật khẩu" id="input-formp">
                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" id="input-formp">
                <input type="submit" value="Đăng ký" id="btn-user">
                @csrf
            </form>
            <div class="row">
                    <h5 class="col-8" style="text-align:left;"><a href="">Quên Mật khẩu</a></h5>
                    <h5 class="col-4" style="text-align:right;"><a href="/user/login">Đăng nhập</a></h5>
            </div>
            <hr>
            <div class="row">
                <a href="/login/facebook" class="col-6 btn-blocks" style="background-color:#007bff"><i class="fa fa-facebook mr-2"></i> Facebook</a>
                <a href="/login/google" class="col-6 btn-blocks" style="background-color:#dc3545"><i class="fa fa-google mr-2"></i> Google</a>
            </div>
        </div>
    </div>
</section>


@endsection