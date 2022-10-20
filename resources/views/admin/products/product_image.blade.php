@extends('admin.users.main')

@section('content')

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Số ảnh</th>
                    <th style="width:120px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="/admin/products/image/{{ $product->id }}"><img src="{{ $product->thumb }}" class="admin-thumb"> </a></td>
                    <td>{{ $product->name }}</td>
                    <td></td>
                    <td>{{ $product->menus->name }}</td>
                </tr>    
            </tbody>
        </table>
    </div>
</div>


<div>
    <div class="modal-header">
        <h5>Thêm ảnh</h5>
    </div>
    <div class="modal-body">
        <!-- Form tạo sản phẩm -->
        <form method="post" enctype="multipart/form-data" action="">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="hidden" value="{{ $id }}" name="product_id">
                        <input type="file" class="custom-file-input upload_image_mul" id="file" name="file[]" multiple>
                        <label class="custom-file-label" class="image_name"></label>
                    </div>
                </div>
                <div class="preview-image d-flex">
                    
                </div>
            </div>
            <div class="modal-footer">
                @csrf
                <input type="submit" name="update-product"  class="btn btn-primary" value="Thêm ảnh sản phẩm" id="btn-update">
            </div>
        </form>
        <!-- Hết form -->
    </div>
</div>
@endsection
