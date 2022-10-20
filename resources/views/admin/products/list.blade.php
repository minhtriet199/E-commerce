@extends('admin.users.main')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 300px;">
                <input type="text" name="table_search" class="form-control float-right search-product" placeholder="Tìm kiếm...  " style="font-size:15px;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Số lượng</th>
                    <th>Giá gốc</th>
                    <th>Giá khuyến mãi</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật</th>
                    <th style="width:120px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td><img src="{{ $product->thumb }}" class="admin-thumb"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->menus->name }}</td>
                        <td>{{ $product->amount }}</td>
                        <td>{{ number_format($product->price,0,',','.')}} đ</td>
                        <td>{{ number_format($product->price_sale,0,',','.')}} đ</td>
                        <td>{!! Helper::active($product->active) !!}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>  
                            <a class="btn btn-primary btn-sm"  href="/admin/products/edit/{{ $product->id }}"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{ $product->id }} ,'/admin/products/destroy')"> <i class="fas fa-trash"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer clearfix">
            {!! $products->links() !!}
        </div>
    </div>
</div>

@endsection
