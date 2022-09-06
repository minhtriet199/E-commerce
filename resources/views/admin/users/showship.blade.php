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
                    <th>Thành phố</th>
                    <th>Quận</th>
                    <th>Giá</th>
                    <th style="width:120px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cities as $key => $city)
                    <tr>
                        <td>{{ $city->city->name }}</td>
                        <td>{{ $city->district->name }}</td>
                        <td>{!! \App\Helpers\Helper::currency_format($city->fee) !!}</td>
                        <td>  
                            <a class="btn btn-primary btn-sm"  href="/admin/citys/edit/{{ $city->id }}"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{ $city->id }} ,'/admin/citys/destroy')"> <i class="fas fa-trash"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer clearfix">
        </div>
    </div>
</div>

@endsection