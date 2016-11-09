@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>{{ trans('message.edit_profile') }}</h1>
        <hr>
        <div class="row">
            {{ Form::open(['method' => 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
                <!-- left column -->
                <div class="col-md-3">
                    <div class="text-center">
                        <?php $avatar = !empty($user->avatar) ? $user->avatar : config('path.to_avatar_default') ?>
                        <img src="{{ $avatar }}" class="avatar img-circle image_size" alt="avatar">
                        <h6>{{ trans('message.upload_avatar') }}</h6>
                        {{ Form::file('avatar', ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- edit form column -->
                <div class="col-md-9 personal-info">
                    <h3>{{ trans('message.user_info') }}</h3>
                    <div class="form-group">
                        {{ Form::label('name', trans('message.name'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-lg-8">
                            {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', trans('message.email'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-lg-8">
                            {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', trans('message.password'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-lg-8">
                            {{ Form::password('password', ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('confirm_password', trans('message.confirm_password'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-lg-8">
                            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-8">
                            {{ Form::submit( trans('message.save_changes'), ['class' => 'btn btn-primary']) }}
                            {{ Form::hidden('_token', csrf_token()) }}
                            <span></span>
                            <input type="reset" class="btn btn-default" value="{{ trans('message.cancel') }}">
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
