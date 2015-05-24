@extends('master')

@section('content')
<h1>{{$title}}</h1>
@foreach($questions as $question)
<div class="row question">
    <div class="col-xs-1 col-md-1">
        @if(Sentry::check())
        <div class="vote_up">
            <a href="{{URL::route('question_vote_get', array('like', $question->id))}}" title="">
                <span class="glyphicon glyphicon-triangle-top"></span>
            </a>
        </div>
        <div class="vote_down">
            <a href="{{URL::route('question_vote_get', array('dislike', $question->id))}}" title="">
                <span class="glyphicon glyphicon-triangle-bottom"></span>
            </a>
        </div>
        @endif
    </div><!--end of vote-->
    <div class="col-xs-2 col-md-2 info vote_info">
        <div class="votes">
            <span class="number">{{$question->vote}}</span> <br/><span class="text">Binh chon</span>
        </div>
    </div>
    <div class="col-xs-2 col-md-2 info answer_info">
        <div class="answer">
            <span class="number">0</span> <br/><span class="text">Tra loi</span>
        </div>
    </div>
    <div class="col-xs-7 col-md-7">
        <div class="question-title">
            <a href="{{URL::route('question_detail_get', array($question->id, Unicode::make($question->title) . '.html'))}}" title="">{{$question->title}}</a>
        </div>
        <div class="time-sent">
            Gui boi <a href="">{{$question->user->username}}</a> - {{$question->timeAgo}}
        </div>
        <div class="tags">
            @foreach($question->tags as $tag)
            <div class="tag"><a href="{{URL::route("question_tags_get", array($tag->alias))}}" title="">{{$tag->tag}}</a></div>
            @endforeach
        </div>
    </div>
</div>
@endforeach
{{$questions->links()}}
@stop

@section('data_code')
<script type="text/javascript">
$(document).ready(function(){
    $('.vote_up a, .vote_down a').click(function(e){
        e.preventDefault();
        $this = $(this);
        var url = $this.attr('href');
        $.get(url,function(data){
            $this.parents('.question').find('.votes > .number').html(data);
        });
    });
});
</script>
@stop