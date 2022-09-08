@extends('admin.users.main')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="/admin/create" type="submit" class="btn btn-primary" style="float:left">Thêm</a>
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
    <div class="card-body table-responsive p-0" id="table-fee">
        <table class="table table-hover text-nowrap" >
            <thead>
                <tr>
                    <th>Thành phố</th>
                    <th>Quận</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody >
                @foreach($fees as $key => $fee)
                    <tr id="fee{{ $fee->id }}">
                        <td>{{ $fee->city->name }}</td>
                        <td>{{ $fee->district->name }}</td>
                        <td contenteditable="true" data-id="{{ $fee->id }}" class="fee_edit">{{ number_format($fee->fee,0,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer clearfix">
        </div>
    </div>
</div>

@endsection