@extends('main')

@section('content')

    <section>
        <div class="container">
            <div class="mid-table">
                <form action="{{ url('/user/change_pass') }}" method="POST" >
                    <h2>Đổi mật khẩu</h2>
                    @include('block.alert')
                    <input type="hidden" name="token" value=" {{ $token }}">
                    <input type="password" name="password" placeholder="Mật khẩu" id="input-formp">
                    <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" id="input-formp">
                    <input type="submit" value="Đổi pass" id="btn-user">
                    @csrf
                </form>
            </div>
        </div>
    </section>

@endsection