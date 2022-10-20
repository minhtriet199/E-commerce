<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      
      <!-- Navbar notification -->
      <li class="nav-item dropdown">
        <a class="nav-link notify-button" data-toggle="dropdown" href="#" aria-expanded="true">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge count-notify display" style="font-size:12px">@php  echo count($all) @endphp</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px; ">
          <span class="dropdown-item dropdown-header"><span class="display">@php  echo count($all) @endphp </span> Đơn hàng mới</span>
          <div class="notify_bar" style="height:200px;overflow:hidden;overflow-y:scroll;">
            @foreach($notify as $item)
                <div class="dropdown-divider"></div>
                <a href="/admin/order/edit/{{$item->order_id}}" class="dropdown-item">
                  {!! Helper::notify_status($item->active) !!}{{ $item->content}}
                  <span class="float-right text-muted text-sm">
                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                  </span>
                </a>
            @endforeach
          </div>
          <div class="dropdown-divider"></div>
          <a href="/admin/order/list/0" class="dropdown-item dropdown-footer">Xem toàn bộ</a>
        </div>
      </li>


    </ul>
  </nav>

 <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
<script type="text/javascript">

    var notificationCount = $('.count-notify').text();
    var notifyCount = parseInt(notificationCount);
    var notify = $('.notify_bar');

    var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        cluster: 'ap1',
        encrypted: true
    });
    var channel = pusher.subscribe('Notify');

    channel.bind('send-notify', function(data) {
      var existingNotifications = notify.html();
      var newNotificationHtml =`
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-circle mr-2" style="color:red;"></i>`+ data.content+`
          <span class="float-right text-muted text-sm">
            {{ \Carbon\Carbon::parse(`+ data.created_at+`)->diffForHumans() }}

          </span>
        </a>
      `;
        notify.html(newNotificationHtml + existingNotifications);
        notifyCount += 1;
        $('.display').text(notifyCount);
    });
    
    
</script>

  