@extends('blank')

@section('content')
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
        {{Form::open(array('route' => 'login_post'))}}
            <div class="form-login">
            <h4>Welcome back.</h4>
            @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
            @elseif(Session::has('success'))
            <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
            @endif
            <input name="username" type="text" id="userName" class="form-control input-sm chat-input" placeholder="username" />
            </br>
            <input name="password" type="password" id="userPassword" class="form-control input-sm chat-input" placeholder="password" />
            </br>
            <div class="wrapper">
            <span class="group-btn">
                <button type="submit" class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></button>
            </span>
            </div>
            </div>
        {{Form::close()}}
        </div>
    </div>
@stop