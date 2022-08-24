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
                    <th>ảnh</th>
                    <th>Tên</th>
                    <th>Đường dẫn</th>
                    <th>Thứ tự</th>
                    <th>Ngày cập nhật</th>
                    <th style="width:150px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $key => $slider)
                    <tr>
                        <td><a href="{{ $slider->thumb }}"><img src="{{ $slider->thumb }}" class="admin-thumb"></a></td>
                        <td>{{ $slider->name }}</td>
                        <td>{{ $slider->url }}</td>
                        <td>{{ $slider->sort_by }}</td>
                        <td>{{ $slider->updated_at }}</td>
                        <td>  
                            <a class="btn btn-primary btn-sm"  href="/admin/sliders/edit/{{ $slider->id }}"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{ $slider->id }} ,'/admin/sliders/destroy')"> <i class="fas fa-trash"></i> </a>
                        </td>
                    </tr>';
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection
