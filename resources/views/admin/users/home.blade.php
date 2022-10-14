@extends('admin.users.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div> 

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3> {{$order_total}} Đơn hàng</h3>
                        <p>Tổng số đơn hàng</p>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{number_format($month_total,0,',',',')}} đ</h3>
                        <p>Tổng doanh thu tháng này</p>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{number_format($today_total,0,',',',')}} đ</h3>
                        <p>Tổng doanh thu hôm nay</p>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$user_total}}</h3>
                        <p>Tổng số user</p>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="row">
            <section class="col-lg-5 connectedSortable ui-sortable">
                <div class="card">
                    <div class="card-header ui-sortable-handle">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Thông tin đơn hàng
                        </h3>
                    </div>
                    <div class="card-body table-responsive p-0" style="margin-top:20px">
                        <div class="row dashboard_info">
                            <div class="col-lg-3">
                                <h4>{{$pending_order}}</h4>
                                <h5>Đơn hàng chờ</h5>
                            </div>
                            <div class="col-lg-3">
                                <h4>{{$shipping_order}}</h4>
                                <h5>Đơn hàng vận chuyển</h5>
                            </div>
                            <div class="col-lg-3">
                                <h4>{{$success_order}}</h4>
                                <h5>Đơn hàng thành công</h5>
                            </div>
                            <div class="col-lg-3">
                                <h4>{{$refund_order}}</h4>
                                <h5>Đơn hàng hoàn tiền</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-7 connectedSortable ui-sortable">
                <div class="card">
                    <div class="card-header ui-sortable-handle">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Đơn hàng mới hôm nay
                        </h3>
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
                            <tbody>
                                @foreach($orders as $key => $order)
                                    <tr>
                                        <th><a href="/admin/order/edit/{{$order->id}}">{{$order->id}}</a></th>
                                        <th>{{ $order->created_at->format('d/m/y') }}</th>
                                        <th>{{ $order->username }}</th>
                                        <th>0{{ $order->phone }}</th>
                                        <th>{{ number_format($order->total,0,',','.') }} đ</th>
                                        <th>{!! \App\Helpers\Helper::orderStatus($order->status) !!}</th>
                                        <th>{!! \App\Helpers\Helper::order_button($order,$order->status) !!}</th>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <canvas id="myChart" height="100px"></canvas>
    </div>
</section>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <!-- Bí  -->
 <script>
    var month = <?php echo $month; ?>;
    var order = <?php echo $order; ?>;
    var barChartData = {
        labels: month,
        datasets: [{
          label: 'order',
          backgroundColor: 'blue',
          borderColor: 'blue',
          data: order,
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("myChart").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'line',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'monthly order Joined'
                }
            }
        });
    };
</script>

