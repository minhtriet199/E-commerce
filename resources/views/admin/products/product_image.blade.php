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
@endsection