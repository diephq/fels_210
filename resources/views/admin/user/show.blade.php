@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('message.user') }} {{ $user->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('admin/user/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open(['method'=>'DELETE', 'url' => ['/admin/user', $user->id]]) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"  />', ['type' => 'submit','class' => 'btn btn-danger btn-xs',
                                'onclick'=>'return confirm("' . trans('message.delete_confirm') . '")'
                        ]) !!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <td><?php $avatar = !empty($user->avatar) ? $user->avatar : config('path.to_avatar_default') ?>
                                        <img src="{{ $avatar }}" class="avatar img-circle image_size" alt="avatar">
                                    </td>
                                        <tr><th>{{ trans('message.id') }}</th><td>{{ $user->id }}</td></tr>
                                    <tr><th>{{ trans('message.name') }}</th><td> {{ $user->name }} </td></tr>
                                    <tr><th>{{ trans('message.email') }}</th><td> {{ $user->email }} </td></tr>
                                    <tr><th>{{ trans('message.role') }}</th><td>{{ $user->role }}</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
