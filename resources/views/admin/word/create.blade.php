@extends('admin.layouts.master')

@section('js')
    @parent
    {{ Html::script('assets/js/admin_word.js') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('message.admin_word.create_new_word') }}</div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::open(['url' => '/admin/word', 'class' => 'form-horizontal', 'files' => true]) !!}
                        @include ('admin.word.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
