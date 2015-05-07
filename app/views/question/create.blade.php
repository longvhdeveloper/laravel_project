@extends('master')
@section('content')
{{Form::open(array('route' => 'question_create_post'))}}
<fieldset>
    <div id="legend">
        <legend>{{$title}}</legend>
    </div>
    <div class="col-md-8 register">        
        <div class="control-group">
            {{Form::label('category', 'Category', array('class' => 'control-label'))}}
            <div class="controls">
                {{Form::select('category', $categories, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="control-group">
            {{Form::label('title', 'Title', array('class' => 'control-label'))}}
            <div class="controls">
                {{Form::text('firstname', Input::old('title'), array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="control-group">
            {{Form::label('content', 'Content', array('class' => 'control-label'))}}
            <div class="controls">
                {{Form::textarea('content', Input::old('Content'), array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="control-group">
            {{Form::label('tag', 'Tag', array('class' => 'control-label'))}}
            <div class="controls">
                {{Form::text('tag', Input::old('tag'), array('class' => 'form-control'))}}
                <code>Cac tu khoa viet khong dau cach nhau boi dau phay, va khoang trang thay bang dau gach ngang. Vi du : hoc-php</code>
            </div>
        </div>
        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                {{Form::submit('Create question', array('class' => 'btn btn-success'))}}
            </div>
        </div>
    </div>
</fieldset>

{{Form::close()}}
@stop
