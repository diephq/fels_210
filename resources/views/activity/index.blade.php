@extends('layouts.master')

@section('content')
    <div class="container category">
        <div class="col-md-10 col-md-offset-1">
            <h1 class="page-header title">{{ trans('message.activities') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="list-group">
                    @foreach($activities as $activity)
                        <?php $avatar = !empty($activity->avatar) ? $activity->avatar : config('path.to_avatar_default') ?>
                        <li class="list-group-item list-item">
                            <div class="avatar">
                                <img src="{{ $avatar }}" class="avatar img-circle image_size_small" alt="avatar">
                            </div>
                            <div class="">
                                <span>{{ $activity->user_name }}</span>
                            </div>
                            <div class="category_name">
                                <b><span>{{ $activity->category_name }}</span></b>
                            </div>
                            <div class="email">
                                /<span>{{ $activity->lesson_name }}</span>
                            </div>
                            <span>{{ $activity->created_at }}</span>
                            <div class="score">
                                <span class="badge">{{ (int) $activity->score }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{ $activities->links() }}
            </div>
        </div>
    </div>
@stop