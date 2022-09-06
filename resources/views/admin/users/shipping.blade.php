@extends('admin.users.main')

@section('content')

<form action="" method="POST">
    <div class="card-body">
        <div class="form-group">
            <label >Thành phố</label>
            <select name="menu_id" class="custom-select rounded-0 choose city"  id="city">
                <option value=""> Chọn thành phố</option>
                @foreach($citys as $city)
                    <option value="{{ $city->id}}"> {{ $city->name}} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label >Quận,Huyện</label>
            <select  name="district" id="district" class="custom-select rounded-0 choose district">
                <option>---Chọn quận huyện---</option>
            </select>
        </div>

        <div class="form-group">
            <label>Chi phí vận chuyển</label>
            <input type="number" name="fee" class="form-control">
        </div>
    </div>
    <div class="card-footer">
        <button type="button" name="add_delivery" class="btn btn-primary add-delivery">Thêm phí vận chuyển</button>
    </div>
    @csrf
</form>

@endsection
