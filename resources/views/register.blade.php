<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("frontend/asset/css/styleLogin.css")}}">
    <title>Đăng Ký</title>
</head>
<body>
    <div class="wrapper">
        <form action="" method="POST">
            <h1>Đăng Ký</h1>
            <div class="input-box">
                <input type="text" name= "username" placeholder="Tên Đăng Nhập" required>
                <i class="ri-user-fill"></i>
            </div>
            <div class="input-box">
                <input type="password"  name= "password" placeholder="Email" required>
                <i class="ri-mail-line"></i>
            </div>
             <div class="input-box">
                <input type="password"  name= "password" placeholder="Mật Khẩu" required>
                <i class="ri-lock-line"></i>
            </div>
             <div class="input-box">
                <input type="password"  name= "password" placeholder="Nhập Lại Mật Khẩu" required>
                <i class="ri-lock-line"></i>
            </div>
            
            <button type="submit" class="btn">Đăng ký</button>
                @csrf
        </form>
    </div>
</body>
</html>