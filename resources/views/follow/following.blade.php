@extends('layouts.master')

@section('content')
    <div class="container category">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="page-header title">{{ trans('message.follow.following') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="list-group">
                    @foreach($users as $user)
                        @if (!empty($user->following))
                        <?php $avatar = !empty($user->following['avatar']) ? $user->following['avatar'] : config('path.to_avatar_default') ?>
                        <li class="list-group-item list-item">
                            <div class="avatar">
                                <img src="{{ $avatar }}" class="avatar img-circle image_size_small" alt="avatar">
                            </div>
                            <div class="name">
                                <span>{{ $user->following['name'] }}</span>
                            </div>
                            <div class="email">
                                <span>{{ $user->following['email'] }}</span>
                            </div>
                            <div class='btn-show-follow'>
                                {{ Form::hidden('_token', csrf_token(), ['id' => '_token']) }}
                                {{ Form::submit(trans('message.follow.following'), ['class' => 'btn-follow btn-following follow', 'id' => 'follow', 'target_id' => $user->following['id'] ]) }}
                            </div>
                            
                        </li>
                        @endif
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
