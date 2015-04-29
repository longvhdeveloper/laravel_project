@extends('blank')

@section('content')
    {{Form::open(array('route' => 'register_post'))}}
    <fieldset>
        <div id="legend">
            <legend>{{$title}}</legend>
        </div>
        <div class="info_code">
            <i>Vui long nhap day du thong tin de dang ky thanh vien. Thong tin cua ban se duoc bao mat tuyet doi</i>
        </div>
        <div class="col-md-6 register">
            @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
            @elseif(Session::has('success'))
            <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
            @endif
            <div class="control-group">
                {{Form::label('firstname', 'First name', array('class' => 'control-label'))}}
                <div class="controls">
                    {{Form::text('firstname', Input::old('firstname'), array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="control-group">
                {{Form::label('lastname', 'Last name', array('class' => 'control-label'))}}
                <div class="controls">
                    {{Form::text('lastname', Input::old('lastname'), array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="control-group">
                {{Form::label('username', 'Username', array('class' => 'control-label'))}}
                <div class="controls">
                    {{Form::text('username', Input::old('username'), array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="control-group">
                {{Form::label('email', 'Email', array('class' => 'control-label'))}}
                <div class="controls">
                    {{Form::email('email', Input::old('email'), array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="control-group">
                {{Form::label('password', 'Password', array('class' => 'control-label'))}}
                <div class="controls">
                    {{Form::password('password', array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="control-group">
                {{Form::label('repassword', 'Re password', array('class' => 'control-label'))}}
                <div class="controls">
                    {{Form::password('repassword', array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="control-group">
            {{Form::label('captcha', 'Captcha', array('class' => 'control-label'))}}
            {{Form::captcha()}}
            </div>
            <div class="control-group">
                <!-- Button -->
                <div class="controls">
                    {{Form::submit('Register', array('class' => 'btn btn-success'))}}
                </div>
            </div>
        </div>
    </fieldset>

    {{Form::close()}}
@stop