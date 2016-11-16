@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('message.category.category') }} {{ $category->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('admin/category/' . $category->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Category"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open(['method'=>'DELETE','url' => ['admin/category', $category->id]]) !!}
                        {!! Form::submit(trans('message.remove'), ['class' => 'btn btn-danger btn-xs', 'onclick'=>'return confirm("' . trans('message.delete_confirm') . '")']) !!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th>{{ trans('message.category.id') }}</th><td>{{ $category->id }}</td></tr>
                                    <tr><th>{{ trans('message.category.name') }}</th><td> {{ $category->name }} </td></tr>
                                    <tr><th>{{ trans('message.category.description') }}</th><td> {{ $category->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
