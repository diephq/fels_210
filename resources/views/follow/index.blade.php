@extends('layouts.master')

@section('content')
    <div class="container category">
        <div class="col-md-10 col-md-offset-1">
            <h1 class="page-header title">{{ trans('message.follow.all_users') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="list-group">
                    @foreach($users as $user)
                        <?php $avatar = !empty($user->avatar) ? $user->avatar : config('path.to_avatar_default') ?>
                        <li class="list-group-item list-item">
                            <div class="avatar">
                                <img src="{{ $avatar }}" class="avatar img-circle image_size_small" alt="avatar">
                            </div>
                            <div class="name">
                                <span>{{ $user->name }}</span>
                            </div>
                            <div class="email">
                                <span>{{ $user->email }}</span>
                            </div>
                            <div class="btn-show-follow">
                            {{ Form::hidden('_token', csrf_token(), ['id' => '_token']) }}
                            @if (!empty($user->following[0]))
                                {{ Form::submit(trans('message.follow.following'), ['class' => 'btn-follow btn-following follow', 'id' => 'follow', 'target_id' => $user->id ]) }}
                            @else
                                {{ Form::submit(trans('message.follow.follow'), ['class' => 'btn-follow follow', 'id' => 'follow', 'target_id' => $user->id]) }}
                            @endif
                            </div>
                            
                        </li>
                    @endforeach
                </ul>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    {{ Html::script('assets/js/follow.js') }}
    <script>
        $(document).ready(function(){
            $(".follow").click(function(e){
                e.preventDefault();
                var target_id = $(this).attr('target_id');
                var following = '{{ config('constants.FOLLOWING') }}';
                var _token = $("#_token").val();
                var button_following = '{{ trans('message.follow.following') }}';
                var button_follow = '{{ trans('message.follow.follow') }}';

                var follow = new Follow(target_id, following, _token, this, button_following, button_follow);
                follow.init();
            });
        });
    </script>
@stop
