@extends('admin.users.main')
@section('content')

<div class="card">

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap" >
            <thead>
                <tr>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng comment</th>
                    <th style="width:120px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $item)
                    <tr>
                        <th><a href="/admin/comment/product/{{ $item->product_id }}">
                            <img src="{{ $item->thumb }}" style="width:100px">
                        </a></th>
                        <th>{{ $item->name }}</th>
                        <th>{{ $item->total }}</th>
                        <th></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

  

@endsection