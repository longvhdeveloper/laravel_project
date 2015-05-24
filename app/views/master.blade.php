<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>{{$title}}</title>
        <!-- Bootstrap core CSS -->
        <link href="{{asset('public/css/bootstrap.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{asset('public/css/jumbotron.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/main.css')}}">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="{{asset('public/js/ie-emulation-modes-warning.js')}}"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        @include('template/top')

        <div class="container">
            <div class="row">
                <div class="col-md-9 content">
                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
                    @elseif(Session::has('success'))
                    <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                    @endif

                    @yield('content')
                </div>
                <div class="col-md-3 menu-right">
                    @include('template/menu')
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{asset('public/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/js/bootstrap.js')}}"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="{{asset('public/js/ie10-viewport-bug-workaround.js')}}"></script>
        @yield('data_code')
    </body>
</html>