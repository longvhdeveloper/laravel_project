<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Noi dung email</title>
    </head>
    <body>
        <h1>Xin chao , {{$user}}</h1>
        Cam on ban da thuc hien yeu cau xac nhan lay lai mat khau, sau day la mat khau moi cua ban:<br/>
        Mat khau : <b>{{$pass}}</b>
        <br/><br/>
        <a href="{{URL::route('index')}}" target="_blank">Nhap chuot de tro ve trang web faq</a>

        Tran trong
    </body>
</html>
