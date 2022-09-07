@extends('main')

@section('content')
    
<section class="profile-container">
    <div class="container">
        <div class="row" style="margin:100px 0px">
            <div class="col-lg-3 col-md-4">
                <div class="nav flex-column nav-pills custom-nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border:#E98C81 1px solid">
                    <a class="nav-link active" data-toggle="pill" href="#profile" role="tab" aria-selected="true">
                        <i class="fa fa-solid fa-user"></i> Hồ sơ
                    </a>
                    <a class="nav-link"  data-toggle="pill" href="#payment" role="tab" aria-selected="false">
                        <i class="fa fa-credit-card"></i> Liên kết ngân hàng
                    </a>
                    <a class="nav-link" data-toggle="pill" href="#change-pass" role="tab"  aria-selected="false">
                        <i class="fa fa-lock"></i> Đổi mật khẩu
                    </a>
                    @if(Auth::user()->level > 0)
                        <a href="/admin/" class="nav-link"> <i class="fa fa-solid fa-key"></i> Trang admin</a>
                    @endif
                    <a class="nav-link" data-toggle="pill" href="#order" role="tab" aria-selected="false">
                        <i class="fa fa-shopping-cart"></i> Đơn hàng
                    </a>
                    <a class="nav-link" data-toggle="pill" href="#voucher" role="tab" aria-selected="false">
                    <i class="fa fa-ticket"></i> Kho voucher
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-md-8" style="height=900px;">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
                        <div class="account-table">
                            <h4>Hồ sơ</h4>
                            <div class="account-table-content">


                                <form id="update" method="POST">
                                    <p id="user-alert"></p>
                                    <div class="row"> 
                                        <div class="col-lg-6 ">
                                            <p>Họ tên</p>
                                            <input type="text" name="name" value="{{ $users->profile->name}}">
                                        </div>
                                        <div class="col-lg-6 ">
                                            <p>Số điện thoại</p>
                                            <input type="number" name="phone" value="{{ $users->profile->phone}}">
                                        </div>
                                    </div>
                                    <p>Địa chỉ</p>
                                    <input type="text" name="address" value="{{ $users->profile->address}}">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>Thành phố</p>
                                            <select name="city" id="city" class="custom-select rounded-0 choose city">
                                                <option value="0"> {{ $users->profile->city}}</option>
                                                @foreach($citys as $city)
                                                    <option value="{{ $city->id}}"> {{ $city->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>Quận,Huyện</p>
                                            <select  name="district_id" id="district" class="custom-select rounded-0 district">
                                                <option value="0"> {{ $users->profile->district}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{$users->profile->id}}" data-id="{{$users->profile->id}}">
                                    <button type="button"  id="btn-update-user">Cập nhật</button>
                                    @csrf
                                </form>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payment" role="tabpanel" >ds</div>
                    <div class="tab-pane fade" id="change-pass" role="tabpanel" >
                        <div class="account-table">
                            <h4>Đổi mật khẩu</h4>
                            <div class="account-table-content">
                                <form id="update-password">
                                    <p id="user-alert-password"></p>
                                    <p>Mật khẩu hiện tại</p>
                                    <input type="text" name="password" value="">
                                    <p>Mật khẩu mới</p>
                                    <input type="text" name="new_pass" value="">
                                    <p>Xác nhận mật khẩu mới</p>
                                    <input type="text" name="confirm_pass" value="">

                                    <input type="hidden" name="id" value="{{$users->id}}" data-id="{{$users->id}}">
                                    <button type="button" onclick="updatePass()" id="btn-update-user">Cập nhật</button>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="order" role="tabpanel">...</div>
                    <div class="tab-pane fade" id="voucher" role="tabpanel" >...</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection