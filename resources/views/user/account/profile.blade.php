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
                    <a class="nav-link" data-toggle="pill" href="#change-pass" role="tab"  aria-selected="false">
                        <i class="fa fa-lock"></i> Đổi mật khẩu
                    </a>
                    <a class="nav-link" data-toggle="pill" href="#order" role="tab" aria-selected="false">
                        <i class="fa fa-shopping-cart"></i> Đơn hàng
                    </a>
                    <a class="nav-link" data-toggle="pill" href="#voucher" role="tab" aria-selected="false">
                    <i class="fa fa-ticket"></i> Kho voucher
                    </a>
                    @if(Auth::user()->role > 0)
                        <a href="/admin/" class="nav-link"> <i class="fa fa-solid fa-key"></i> Trang admin</a>
                    @endif
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
                                            <input type="text" name="name" value="{{ $account->profile->name}}">
                                        </div>
                                        <div class="col-lg-6 ">
                                            <p>Số điện thoại</p>
                                            <input type="number" name="phone" value="0{{ $account->profile->phone}}">
                                        </div>
                                    </div>
                                    <p>Địa chỉ</p>
                                    <input type="text" name="address" value="{{ $account->profile->address}}">
                                    @include('block.cd')
                                    <input type="hidden" name="user_id" value="{{$account->profile->id}}" data-id="{{$account->profile->id}}">
                                    <button type="button"  id="btn-update-user">Cập nhật</button>
                                    @csrf
                                </form>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="change-pass" role="tabpanel" >
                        <div class="account-table">
                            <h4>Đổi mật khẩu</h4>
                            <div class="account-table-content">
                                <form id="update-password" action="{{ url('user/link-reset') }}" method="POST">
                                    @include('block.alert')
                                    <p>Nhập email</p>
                                    <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email">
                                    <button type="submit" id="btn-update-user">Đổi mật khẩu</button>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="order" role="tabpanel">
                        <div class="account-table-2" >
                            <div class="account-table-content">
                                <h3 style="margin-bottom:20px">Danh sách đơn hàng</h3>
                                @foreach($orders as $order)
                                    <div class="order-card" >
                                        <div class="head row" > 
                                            <div class="col-lg-9">{!! \App\Helpers\Helper::orderStatus($order->status) !!}</div>
                                            <span class="col-lg-3">Tổng tiền: <label class="total-order">{{ number_format($order->total,0,',','.') }} đ</label></span>
                                        </div>
                                        <hr>
                                        @foreach($order->order_details as $detail)
                                            <div class="body row">
                                                <img src="{{ $detail->thumb}}" class="col-lg-2" style="with:100px">
                                                <span class="col-lg-8">x{{$detail->quantity}} <h3>{{$detail->product_name}}</h3></span>
                                                <span class="col-lg-2">{{ number_format($detail->price,0,',','.') }} đ</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="voucher" role="tabpanel" >
                        <div class="account-table">
                            <h4 >Kho voucher</h4>
                            <div class="account-table-content">
                                <table id="table-product">
                                    <thead>
                                        <tr>
                                            <td>Mã giảm giá</td>
                                            <td>Giá giảm</td>
                                            <td>Ngày hết hạn</td>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($vouchers as $voucher)
                                            <tr>
                                                <td>{{ $voucher->voucher_code }}</td>
                                                <td>{{ number_format($voucher->discount,0,',','.') }} đ</td>
                                                <td>{{ $voucher->expire_date->format('d/m/y')}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection