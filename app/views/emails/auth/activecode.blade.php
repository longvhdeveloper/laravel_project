<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Noi dung email</title>
    </head>
    <body>
        <h1>Xin chao, {{$user}}</h1>
        Ban vua yeu cau chung toi thuc hien thao tac lay lai mat khau, de thuc hien thao tac ban can nhap chuot vao lien ket ben duoi de hoan tat yeu cau lay lai mat khau ma ban dang thuc hien
        <br/><br/>
        <a href="{{URL::route('active_reset', array($user, $code))}}">Nhan chuot vao day de xac nhan</a>
    </body>
</html>
