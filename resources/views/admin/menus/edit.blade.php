@extends('admin.users.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')

<form action="" method="POST">
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên danh mục</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $Menus->name }}">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Danh mục cha</label>
            <select name="parent_id" class="custom-select rounded-0">
                <option value="0" {{ $Menus->parent_id == 0 ? 'selected' : ''}} >Danh mục cha</option>

                @foreach( $menus as $menuParent)
                    <option value="{{ $menuParent->id }}" 
                    {{ $Menus -> parent_id ==$menuParent->id ? 'selected' : '' }} >
                    {{ $menuParent -> name }}</option>
                @endforeach 

            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả</label>
            <textarea class="form-control" name="description" rows="3" >{{ $Menus->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả chi tiết</label>
            <textarea class="form-control" rows="3" name="content" id="content" >{{ $Menus->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" id="active" value="1" name="active" 
                {{ $Menus->active == 1 ? 'checked="" ' : '' }} >
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" id="no_active" value="0" name="active"
                {{ $Menus->active == 0 ? 'checked="" ' : ''}} >
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection