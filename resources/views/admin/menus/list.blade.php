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
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật</th>
                    <th style="width:120px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Menus as $menu)
                    <tr>
                        <td>{{$menu->id}} </td>
                        <td>{{$menu->name}}</td>
                        <td >{!! Helper::active($menu->active) !!}</td>
                        <td>{{ $menu->updated_at->format('d/m/y | H:i') }}</td>
                        <td>  
                            <a class="btn btn-primary btn-sm"  href="/admin/menus/edit/{{ $menu->id }} "><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{ $menu->id }},'/admin/menus/destroy')"> <i class="fas fa-trash"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection
