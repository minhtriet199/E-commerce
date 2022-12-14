@extends('admin.users.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')

<form action="" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="{{ $product-> name }}" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label>Giá</label>
                    <input type="number" name="price" class="form-control" value="{{ $product-> price }}" placeholder="Nhập giá">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" name="amount" value="{{ $product-> amount }}" class="form-control" placeholder="Nhập số lượng">
                </div>
                 
                <div class="form-group">
                    <label>Giá giảm giá</label>
                    <input type="number" name="price_sale" value="{{ $product-> price_sale }}" class="form-control" placeholder="Nhập giá" >
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Danh mục</label>
            <select name="menu_id" class="custom-select rounded-0">

                @foreach( $menus as $menu)
                    <option value="{{ $menu -> id }}" 
                        {{ $product -> menu_id == $menu->id ? 'selected' : '' }}> 
                        {{ $menu -> name }}
                    </option>
                @endforeach 

            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả</label>
            <textarea class="form-control" name="description" rows="3" placeholder="Nhập ..."> {{ $product -> description }}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả chi tiết</label>
            <textarea class="form-control" rows="3" name="content" id="content" placeholder="Nhập nội dung .."> {{ $product-> content }} </textarea>
        </div>
        
        <div class="form-group">
            <div class="input-file-container">  
                <label >Ảnh sản phẩm</label>
                <input class="input-file" name="file" type="file" id="upload">
                <div id="image_show">
                    <a href="{{ $product-> thumb }}">
                        <img src="{{ $product-> thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $product-> thumb }}" id="thumb">
            </div>
        </div>
        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" id="active" value="1" name="active" 
                    {{ $product -> active == 1 ? 'checked ="" ': '' }}
                >
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" id="no_active" value="0" name="active"
                    {{ $product -> active == 0 ? 'checked ="" ': '' }}
                >
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
