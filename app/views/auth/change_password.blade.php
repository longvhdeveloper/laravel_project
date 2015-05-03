@extends('blank')

@section('content')
{{Form::open(array('route' => 'changepass_post'))}}
<fieldset>
    <div id="legend">
        <legend>{{$title}}</legend>
    </div>
    <div class="col-md-6 register">
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
        @elseif(Session::has('success'))
        <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
        @endif
        <div class="control-group">
            {{Form::label('oldpassword', 'Old Password', array('class' => 'control-label'))}}
            <div class="controls">
                {{Form::password('oldpassword', array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="control-group">
            {{Form::label('newpassword', 'New Password', array('class' => 'control-label'))}}
            <div class="controls">
                {{Form::password('newpassword', array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="control-group">
            {{Form::label('renewpassword', 'Re new password', array('class' => 'control-label'))}}
            <div class="controls">
                {{Form::password('renewpassword', array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="control-group">
        {{Form::label('captcha', 'Captcha', array('class' => 'control-label'))}}
        {{Form::captcha()}}
        </div>
        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                {{Form::submit('Change password', array('class' => 'btn btn-success'))}}
            </div>
        </div>
    </div>
</fieldset>
{{Form::close()}}
@stop