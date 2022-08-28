@extends('admin.users.main')

@section('content')

<form action="" method="POST">
    <div class="card-body">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" class="form-control" name="name" value="{{ $slider-> name}}" placeholder="Nhập tiêu đề">
        </div>
        <div class="form-group">
            <label>Đường dẫn</label>
            <input type="text" name="url" class="form-control" value="{{ $slider-> url}}" placeholder="Nhập Đường dẫn">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Thứ tự</label>
            <input type="number" name="sort_by" class="form-control" value="{{ $slider-> sort_by}}" placeholder="Nhập thứ tự">
        </div>

        <div class="form-group">
            <div class="input-file-container">  
                <label >Ảnh sản phẩm</label>
                <input class="input-file" name="file" type="file" id="upload" value="{{ $slider-> thumb}}">
                <div id="image_show">
                    <a href="{{ $slider-> thumb}}">
                        <img src="{{ $slider-> thumb}}" width="300px">
                    </a>
                </div>
                <input type="hidden" name="thumb" id="thumb" value="{{ $slider-> thumb}}">
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả chi tiết</label>
            <textarea class="form-control" rows="3" name="description" id="content"placeholder="Nhập nội dung ..">{{$slider-> description}}</textarea>
        </div>
 
        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" id="active" value="1" name="active" 
                    {{ $slider -> active == 1 ? 'checked ="" ': '' }}
                >
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" id="no_active" value="0" name="active"
                    {{ $slider -> active == 0 ? 'checked ="" ': '' }}
                >
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Sửa Slider</button>
    </div>
    @csrf
</form>
@endsection

