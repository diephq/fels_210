@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('Category') }}</div>
                <div class="panel-body">

                    <a href="{{ url('/admin/category/create') }}" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>{{ trans('message.category.id') }}</th>
                                    <th>{{ trans('message.category.name') }}</th>
                                    <th>{{ trans('message.category.description') }}</th>
                                    <th>{{ trans('message.category.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($category as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td><td>{{ $item->description }}</td>
                                    <td>
                                        <a href="{{ url('/admin/category/' . $item->id) }}" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/category/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Category"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open(['method'=>'DELETE','url' => ['/admin/category', $item->id]]) !!}
                                        {!! Form::submit(trans('message.remove'), ['class' => 'btn btn-danger btn-xs', 'onclick'=>'return confirm("' . trans('message.delete_confirm') . '")']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $category->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
