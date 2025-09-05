<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("frontend/asset/css/styleLogin.css")}}">
    <title>Đăng Nhập</title>
</head>
<body>
    <div class="wrapper">
        <form action="/check_login" method="POST">
            <h1>Đăng Nhập</h1>
            <div class="input-box">
                <input type="text" name= "username" placeholder="Tên Đăng Nhập" required>
                <i class="ri-user-fill"></i>
            </div>
            <div class="input-box">
                <input type="password"  name= "password" placeholder="Mật khẩu" required>
                <i class="ri-lock-line"></i>
            </div>
             <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="#">Forget password</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register">
                <p>Don't have an account? <a href="/register">Đăng ký</a></p>
                @csrf
        </form>
    </div>
</body>
</html>