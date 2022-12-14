<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="{{ url('assets/admin/img/mini-logo.png')}}" class="brand-image " style="opacity: .8">
      <span class="brand-text font-weight-light">Low-Key</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/assets/admin/dist/img/avatar.png')}} " class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ url('/logout')}}" class="d-block">Đăng xuất</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item ">
            <a href="/admin/" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/account/list" class="nav-link">
              <i class="nav-icon fas fa-user"></i><p> Tài khoản</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-bars"></i>
              <p>
                 Danh mục
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
              <a href="/admin/menus/list" class="nav-link">
                  <p>Danh sách danh mục</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/menus/add" class="nav-link">
                  <p>Thêm Danh mục</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i></i>
              <p>
                 Doanh thu
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
              <a href="/admin/revenue/month" class="nav-link">
                  <p>Danh thu tháng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/revenue/day" class="nav-link">
                  <p>Doanh thu ngày</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-regular fa-tshirt"></i>
              <p>
                Sản phẩm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
              <a href="/admin/products/list" class="nav-link">
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/products/add" class="nav-link">
                  <p>Thêm sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/products/image" class="nav-link">
                  <p>Ảnh sản phẩm</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-images"></i>
              <p>
                 Slider
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
              <a href="/admin/sliders/list" class="nav-link">
                  <p>Danh sách Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/sliders/add" class="nav-link">
                  <p>Thêm Slider</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-solid fa-shopping-cart"></i>
              <p>
                 Đơn hàng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
              <a href="/admin/order/list/0" class="nav-link">
                  <p>Quản lý đơn hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/list/1" class="nav-link">
                  <p>Đơn đang chờ xử lý</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/list/2" class="nav-link">
                  <p>Đơn đang đang giao</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/list/3" class="nav-link">
                  <p>Đơn đang đã thành công</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/list/4" class="nav-link">
                  <p>Đơn đang hoàn tiền</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="/admin/comment/list" class="nav-link">
              <i class="nav-icon fa fa-comment"></i><p>Bình luận</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/shipping" class="nav-link">
              <i class="nav-icon fa fa-truck"></i><p> Giá giao hàng</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/voucher/list" class="nav-link">
              <i class="nav-icon fa fa-ticket-alt"></i><p> Voucher</p>
            </a>
          </li>

          
          <li class="nav-item ">
            <a href="/" class="nav-link active">
            <i class="nav-icon fas fa-home"></i><p> Về shop</p>
            </a>
          </li>

        </ul>
      </nav>
      
      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>