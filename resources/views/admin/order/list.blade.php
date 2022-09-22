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
                    <th>Mã đơn hàng</th>
                    <th>Ngày tạo đơn</th>
                    <th>Khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái đơn hàng</th>
                    <th style="width:120px">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="order-section">
                
            </tbody>
        </table>
        <div class="card-footer clearfix">
    
        </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function fetchorder(){
        $.ajax({
            type: 'get',
            url: 'fetchorder',
            success: function(data) {
                $('#order-section').html(data.result);
            },
        });
    }
    fetchorder();
</script>