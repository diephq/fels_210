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
                    <div class="panel-heading">{{ trans('message.admin_word.edit') }} {{ $word->id }}</div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::model($word, [
                            'method' => 'PATCH',
                            'url' => ['/admin/word', $word->id],
                            'class' => 'form-horizontal',
                        ]) !!}

                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                                {!! Form::label('category_id', trans('message.categories'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    <select name="category_id" class="form-control">
                                        <option value="0">{{ trans('message.select_category') }}</option>
                                        @foreach ($categories as $category)
                                            <option @if($word->category_id == $category->id) selected @endif value="{{ $category->id }}  ">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('text') ? 'has-error' : ''}}">
                                {!! Form::label('text', trans('message.admin_word.text'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('text', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('text', '<p class="help-block">:message</p>') !!}
                                </div>

                            </div>

                            <div class="input_fields_wrap">
                                @foreach ($word->answers as $key => $answer)
                                    <div class="form-group answers">
                                        {!! Form::label('answer', trans('message.admin_word.answer'), ['class' => 'col-md-4 control-label']) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('answer[]', $answer->text, ['class' => 'form-control']) !!}
                                        </div>
                                        {!! Form::radio('true_answer', $key + 1, ($answer->is_correct)) !!}
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    {!! Form::button(trans('message.admin_word.add_more'), ['class' => 'add_field_button add_more']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    {!! Form::submit(trans('message.admin_word.button_update'), ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
