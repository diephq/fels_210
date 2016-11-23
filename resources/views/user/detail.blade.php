@extends('layouts.master')

@section('content')
    <div class="container category">
        <div class="col-md-12">
            <div class="col-md-10 col-md-offset-1">
                <h1 class="page-header title">{{ trans('message.edit_profile') }}</h1>
            </div>
            <div class="panel-body col-md-10 col-md-offset-1">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                {{ Form::open(['method' => 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
                <div class="col-md-3">
                    <div class="text-center">
                        <?php $avatar = !empty($user->avatar) ? $user->avatar : config('path.to_avatar_default') ?>
                        <img src="{{ $avatar }}" class="avatar img-circle image_size" alt="avatar">
                        <h6>{{ trans('message.upload_avatar') }}</h6>
                        {{ Form::file('avatar', ['class' => 'form-control']) }}
                    </div>
                </div>
                    
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
    </div>
@stop
