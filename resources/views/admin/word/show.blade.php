@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('message.admin_word.word') }} {{ $word->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/word/' . $word->id . '/edit') }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open(['method'=>'DELETE','url' => ['admin/word', $word->id]]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"  />', ['type' => 'submit','class' => 'btn btn-danger btn-xs',
                                'onclick'=>'return confirm("' . trans('message.delete_confirm') . '")'
                            ]) !!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>{{ trans('message.id') }}</th><td>{{ $word->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('message.categories') }}</th>
                                        <td> {{ $word->category['name'] }} </td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('message.admin_word.text') }}</th><td> {{ $word->text }} </td>
                                    </tr>
                                    @foreach ($word->answers as $key => $answer)
                                    <tr>
                                        <th>{{ $key + 1  }}/{{ trans('message.admin_word.answer') }}</th><td> {{ $answer->text }} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
