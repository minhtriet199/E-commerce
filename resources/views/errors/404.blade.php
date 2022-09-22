<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Custom Error Page Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 pt-5">
        <div class="alert alert-danger text-center">
            <h1>404</h1>
            <h2>Lỗi !!!! Trang này không tồn tại</h2>
            <p>Xin lỗi nhưng trang bạn đang tìm không tồn tại, đã bị <br> xóa, tên đã thay đổi hoặc tạm thời không có sẵn.</p>
            <a href="/">Về trang chủ..</a>
        </div>
    </div>
</body>
</html>