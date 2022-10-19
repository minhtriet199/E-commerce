@extends('admin.users.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')

<form action="" method="POST"  enctype="multipart/form-data" >
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="{!! old('name') !!}" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label>Giá</label>
                    <input type="number" name="price" class="form-control" value="{!! old('price') !!}" placeholder="Nhập giá">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" name="amount" value="{!! old('amount') !!}" class="form-control" placeholder="Nhập số lượng">
                </div>
                 
                <div class="form-group">
                    <label>Giá giảm giá</label>
                    <input type="number" name="price_sale" value="{!! old('price_sale') !!}" class="form-control" placeholder="Nhập giá" >
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Danh mục</label>
            <select name="menu_id" class="custom-select rounded-0">

                @foreach( $products as $menu)
                    <option value="{{ $menu -> id }}">{{$menu -> name }}</option>
                @endforeach 
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả</label>
            <textarea class="form-control" name="description" rows="3" value="{!! old('description') !!}" placeholder="Nhập ..."></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả chi tiết</label>
            <textarea class="form-control" rows="3" name="content" id="content" value="{!! old('content') !!}" placeholder="Nhập nội dung .."></textarea>
        </div>
        
        <div class="form-group">
            <div class="input-file-container">  
                <label >Ảnh sản phẩm</label>
                <input class="input-file" name="file" type="file" id="file" accept="image/*">
                <div id="image_show">

                </div>
            </div>
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
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
