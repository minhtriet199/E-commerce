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
        <table class="table table-hover text-nowrap">
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
                {!! \App\Helpers\Helper::menu($menus) !!}

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection
