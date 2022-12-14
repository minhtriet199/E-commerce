@extends('admin.users.main')

@section('content')

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Tổng doanh thu</th>
                    <th>Số lượng đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenues as $revenue)
                    <tr>
                        <th>
                            <a href="/admin/order/day/{!! \Carbon\Carbon::now()->day !!}-{!! \Carbon\Carbon::now()->month !!}-{!! \Carbon\Carbon::now()->year !!}">
                                {{ $revenue->created_at->format('d/m/y') }}
                            </a>
                        </th>
                        <th>{{ number_format($revenue->revenue,0,',',',')}} đ</th>
                        <th>{{ $revenue->order}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection