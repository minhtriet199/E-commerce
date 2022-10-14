@extends('admin.users.main')

@section('content')

<form method="POST" id="form">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="exampleInputEmail1">Tên người dùng</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $account['name'] }}">
            </div>
            <div class="form-group col-lg-6">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="{{ $account['email'] }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label >Số điện thoại</label>
                    @if($account->profile['phone'] == "")
                        <input type="text" class="form-control" name="phone" value="0">
                    @else
                        <input type="text" class="form-control" name="phone" value="0{{ $account->profile['phone'] }}">
                    @endif
            </div>
            <div class="form-group col-lg-6">
                <label >Vai trò</label>
                <select class="form-control" name="role">
                    <option value="">Chọn vai trò</option>
                    <option value="0"  
                        {{ $account['role']  == 0 ? 'selected' : '' }}>
                        Khách hàng
                    </option>
                    <option value="1" 
                        {{ $account['role']  == 1 ? 'selected' : '' }}>
                        Admin 
                    </option>
                    <option value="2" 
                        {{ $account['role']  == 2 ? 'selected' : '' }}>
                        Owner</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Địa chỉ</label>
            
            <input type="text" class="form-control" name="address" value="{{ $account->profile['address'] }}">
        </div>
        @include('block.cd')
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhật User</button>
    </div>
    @csrf
</form>
@endsection
