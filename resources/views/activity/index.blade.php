@extends('layouts.master')

@section('content')
    <div class="container category">
        <div class="col-md-10 col-md-offset-1">
            <h1 class="page-header title">{{ trans('message.activities') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="list-group">
                    @foreach ($activities as $activity)
                        <li class="list-group-item">
                            <img src="{{ $activity->user->avatar }}" class="avatar img-circle image_size_small" alt="avatar">
                            <span>{{ $activity->user->name }}</span>
                            <span>{{ $activity->lesson->category->name }}</span>/
                            <span>{{ $activity->lesson->name }}</span>/
                            <span>{{ $activity->created_at }}</span>
                            <span class="badge">{{ (int) $activity->lesson->score }}</span>
                        </li>
                    @endforeach
                </ul>
                {{ $activities->links() }}
            </div>
        </div>
    </div>
@stop
