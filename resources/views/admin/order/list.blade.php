@extends('admin.users.main')

@section('content')

<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body table-responsive p-0 table-data">
        @include('admin.order.show') 
    </div>
</div>

@endsection
