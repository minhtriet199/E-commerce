<!DOCTYPE html>
<html lang="en">
<head>
@include('admin.users.header')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h1>Đăng nhập</h1>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      @include('admin.users.alert')
      <form action="/admin/users/login/store" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email"  class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Lưu đăng nhập
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
          <!-- /.col -->
        </div>
        @csrf
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Đăng nhập facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Đăng nhập google
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">Quên mật khẩu</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Đăng ký</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
@include('admin.users.footer')
</body>
</html>
