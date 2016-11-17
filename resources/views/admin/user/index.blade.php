@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('message.user') }}</div>
                <div class="panel-body">
                    <a href="{{ url('/admin/user/create') }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>{{ trans('message.id') }}</th>
                                    <th>{{ trans('message.avatar') }}</th>
                                    <th>{{ trans('message.name') }}</th>
                                    <th>{{ trans('message.email') }}</th>
                                    <th>{{ trans('message.role') }}</th>
                                    <th>{{ trans('message.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <?php $avatar = !empty($item->avatar) ? $item->avatar : config('path.to_avatar_default') ?>
                                        <img src="{{ $avatar }}" class="avatar img-circle image_size" alt="avatar">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        <a href="{{ action('Admin\UserController@show', ['id' => $item->id]) }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        <a href="{{ action('Admin\UserController@edit', ['id' => $item->id]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open(['method'=>'DELETE', 'url' => ['/admin/user', $item->id]]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"  />', ['type' => 'submit','class' => 'btn btn-danger btn-xs',
                                                    'onclick'=>'return confirm("' . trans('message.delete_confirm') . '")'
                                            ]) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $user->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
