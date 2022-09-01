@extends('main')

@section('content')

<section>
    <div class="container">
            <div class="form-user">
                <form action="{{ url('/user/login/store') }}" onkeypress="Required()" method="POST" >
                    <h2>Đăng nhập</h2>
                    @include('user.alert')
                    <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email" id="input-formu">
                    <input type="text" name="password" placeholder="Mật khẩu" id="input-formp">
                    <input type="submit" value="Đăng nhập" id="btn-user" disabled>
                    {{ csrf_field() }}
                </form>
                <div class="row">
                        <h5 class="col-8" style="text-align:left;"><a href="">Quên Mật khẩu</a></h5>
                        <h5 class="col-4" style="text-align:right;"><a href="">Đăng ký</a></h5>
                </div>
                <hr>
                <div class="row">
                    <a href="" class="col-6 btn-blocks" style="background-color:#007bff"><i class="fa fa-facebook mr-2"></i> facebook</a>
                    <a href="{{ url('login/google')}}" class="col-6 btn-blocks" style="background-color:#dc3545"><i class="fa fa-google mr-2"></i> Google</a>
                </div>
            </div>
    </div>
</section>

@endsection