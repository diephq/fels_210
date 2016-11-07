@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>{{ $category->name }}</h2>
        <hr>
        <h2>{{ $category->description }}</h2>
        <hr>
        <div class="row">
            <div class="col-md-9">
                {{ Form::open(['url' => 'lesson/create', 'method' => 'post']) }}
                <div class="col-md-2">
                    {{ Form::radio('lesson_type', config('constants.LESSON_1')) }} {{ trans('message.name_lesson_1') }}
                </div>
                <div class="col-md-2">
                    {{ Form::radio('lesson_type', config('constants.LESSON_2')) }} {{ trans('message.name_lesson_2') }}
                </div>
                <div class="col-md-2">
                    {{ Form::radio('lesson_type', config('constants.LESSON_3')) }} {{ trans('message.name_lesson_3') }}
                </div>
                {{ Form::hidden('category_id', $category->id )}}
                {{ Form::hidden('user_id', $user->id) }}
                <div class="col-md-2">
                    {{ Form::submit(trans('message.start_lesson'), array('class'=> 'btn btn-primary')) }}
                </div>
                {{ Form::close() }}
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group">
                    @if ($lessons)
                        @foreach($lessons as $key => $lesson)
                            <li class="list-group-item">
                            <div>
                                <span>{{ $key + 1 }}</span>
                                <a href="{{ route('lesson', ['id' => $category->id, 'lessonId' => $lesson->id]) }}">{{ trans('message.result') }}</a>
                                <span class="date_test">{{ $lesson->created_at }}</span>
                                <span class="score badge">{{ (int) $lesson->score }}/{{ $lesson->type }}</span>
                            </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
                {{ $lessons->links() }}
            </div>
        </div>
    </div>
@stop
