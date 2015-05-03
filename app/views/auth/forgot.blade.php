@extends('master')
@section('content')
{{Form::open(array('route' => 'forgot_post'))}}
    <fieldset>
        <div id="legend">
            <legend>{{$title}}</legend>
        </div>
        <div class="col-md-6 register">
            <div class="control-group">
                {{Form::label('username', 'Your username', array('class' => 'control-label'))}}
                <div class="controls">
                {{Form::text('username', '', array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="control-group">
                {{Form::label('captcha', 'Captcha', array('class' => 'control-label'))}}
                {{Form::captcha()}}
            </div>
            <div class="control-group">
                <!-- Button -->
                <div class="controls">
                    {{Form::submit('Send', array('class' => 'btn btn-success'))}}
                </div>
            </div>
        </div>
    </fieldset>
{{Form::close()}}
@stop
