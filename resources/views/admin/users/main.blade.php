

<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.users.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('admin.users.header')
  <!-- Main Sidebar Container -->
  @include('admin.users.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
              </div>
              @include('admin.users.alert')
              
              @yield('content')
            </div>
          </div>
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <strong>Copyright &copy; 2022 <a href="#">Made by minh triet</a>. - project 1</strong> 
    </div>
    
  </footer>

  <!-- Control Sidebar -->

</div>
<!-- ./wrapper -->
@include('admin.users.footer')
</body>
</html>
