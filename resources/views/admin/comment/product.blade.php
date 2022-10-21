@extends('admin.users.main')
@section('content')

<div class="card">
    <section class="text-lg-start">
        <div class="card mb-3">
            <div class="row g-0 d-flex">
            <div class="col-lg-2 d-none d-lg-flex">
                <img src="{{ $product->thumb}}"
                class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
            </div>
            <div class="col-lg-2">
                <div class="card-body py-5 px-md-3">
                    <div>
                        <span><strong>Tên sản phẩm: </strong>{{ $product->name}}</span>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap" >
            <thead>
                <tr>
                    <th>Tên User</th>
                    <th>Content</th>
                    <th>Ngày đăng</th>
                    <th>Tình trạng</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                 @php $i=0 @endphp
                @foreach($comments as $item)
                    @php $i +=1 @endphp
                    <tr data-id='{{ $item->id }}' id="comment{{$item->id}}">
                        <th>{{ $item->name }}</th>
                        <th>{{ $item->Content }}</th>
                        <th>{{ $item->created_at }}</th>
                        <th>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switch-comment" id="customSwitch{{$i}}"   {{ $item -> status == 1 ? 'checked ="" ': '' }}>
                                <label class="custom-control-label" for="customSwitch{{$i}}"></label>
                            </div>
                        </th>
                        <th><button tpye="button" class="btn btn-danger remove-comment"><i class="fa fa-trash"></i></button></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
    
@endsection