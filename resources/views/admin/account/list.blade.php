@extends('admin.users.main')

@section('content')

<table class="table table-hover">
    <thead class="table-dark ">
        <tr>
            <th>Tên tài khoản</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Vai trò</th>
            <th>Ngày tạo</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($accounts as $item)
            <tr data-id="{{ $item['id']}}">
                <th>{{ $item['name'] }}</th>
                <th>{{ $item['email'] }}</th>
                <th>
                    @if($item->profile['phone'] == "")
                        Trống
                    @else
                        0{{ $item->profile['phone'] }}
                    @endif
                </th>
                <th>{!! \App\Helpers\Helper::user_status($item['role']) !!}</th>
                <th>{{ $item['created_at'] }}</th>
                <th>
                    <a href="/admin/account/edit/{{ $item['id'] }}" class="btn btn-primary"> <i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-delete-user"> <i class="fas fa-trash"></i></a>
                </th>
            </tr>
        @endforeach
        <tr>
            <th></th>
        </tr>
    </tbody>
</table>
@endsection
