@extends('admin.users.main')

@section('content')

<form action="" method="POST" >
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Mã Voucher</label>
            <input type="text" class="form-control" name="voucher_code" value="{!! old('voucher_code') !!}" placeholder="Nhập mã voucher">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Giá giảm</label>
                    <input type="number" name="discount" class="form-control" min="0"  value="{!! old('discount') !!}" placeholder="Nhập giá">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" name="quantity" value="{!! old('quantity') !!}" min="0" class="form-control" placeholder="Nhập số lượng">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Ngày hết hạn</label>
            <input type="datetime-local" name="expire_date" class="form-control" min="0" >
        </div>

        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" id="active" value="1" name="active" checked>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" id="no_active" value="0" name="active">
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm Voucher</button>
    </div>
    @csrf
</form>

@endsection
