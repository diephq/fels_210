@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('message.words') }}</div>
                <div class="panel-body">

                    <a href="{{ url('/admin/word/create') }}" class="btn btn-primary btn-xs" title="Add New Word"><span
                                class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>{{ trans('message.id') }}</th>
                                <th>{{ trans('message.categories') }}</th>
                                <th>{{ trans('message.admin_word.word') }}</th>
                                <th>{{ trans('message.admin_word.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($word as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->text }}</td>
                                    <td>
                                        <a href="{{ url('/admin/word/' . $item->id) }}" class="btn btn-success btn-xs"
                                           title="View Word"><span class="glyphicon glyphicon-eye-open"
                                                                   aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/word/' . $item->id . '/edit') }}"
                                           class="btn btn-primary btn-xs" title="Edit Word"><span
                                                    class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/admin/word', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Word" />', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete Word',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $word->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection