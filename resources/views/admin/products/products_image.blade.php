@extends('admin.users.main')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 300px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Tìm kiếm...  " style="font-size:15px;">
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
                    <th>Số ảnh</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product) 
                    <tr>
                        <td><a href="/admin/products/image/{{ $product->id }}"><img src="{{ $product->thumb }}" class="admin-thumb"> </a></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ Helper::count_image($product->id) }}</td>
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