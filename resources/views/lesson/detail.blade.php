@extends('layouts.master')

@section('css')
    @parent
    {{ Html::style('bower_components/flipclock/compiled/flipclock.css') }}
@stop

@section('js')
    @parent
    {{ Html::script('bower_components/flipclock/compiled/flipclock.min.js') }}
    {{ Html::script('assets/js/lesson.js') }}
    @if (empty($lesson->status))
        <script>
            $(document).ready(function () {
                var lesson = new Lesson('{{ $lesson->type }}');
                lesson.init();
            });
        </script>
    @endif
@stop

@section('content')
    <div class="container">
        <h2>{{ $category->name }} > {{ $lesson->name }}</h2>
        <hr>
        <div class="row">
            <div class="clock"></div>
            <ul class="list-group">
                @if (empty($lesson->status))
                    {{ Form::open([ 'method' => 'post']) }}
                    @foreach ($results as $key => $result)
                        <div class="top-10 jumbotron">
                            <p class="question">{{ $key+1 }} . {{ $result->word->text }}</p>
                            <ul class="answers">
                                @foreach($result->word->answers as $answer)
                                    {{ Form::radio("word_id[" . $result->word->id . "]", $answer->id, false) }}
                                    <span class="left-10">{{ $answer->text }}</span> <br>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    {{ Form::hidden('type', $lesson->type) }}
                    {{ Form::hidden('lessonId', $lesson->id) }}
                    {{ Form::submit('Submit', array('id' => 'lesson', 'class' => 'btn btn-primary')) }}
                    {{ Form::close() }}
                @else
                    @foreach ($results as $key => $result)
                        <div class="top-10 jumbotron">
                            <p class="question">{{ $key + 1 }} . {{ $result->word->text }}</p>
                            <ul class="answers">
                                @foreach($result->word->answers as $answer)
                                    {{ Form::radio("word_id[" . $result->word->id . "]", $answer->id,  ($result->answer_id == $answer->id), ['disabled']) }}
                                    <span class="left-10">
                                        @if ($answer->is_correct)<strong>@endif {{ $answer->text }}
                                        @if ($answer->is_correct)</strong> <span class="glyphicon glyphicon-ok"></span>@endif
                                    </span> <br>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@stop
