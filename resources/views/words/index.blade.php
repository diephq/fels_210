@extends('layouts.master')

@section('content')
    <div class="container category">
        <div class="col-md-10 col-md-offset-1">
            <h1 class="page-header title">{{ trans('message.admin_word.word') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                {!! Form::open(array('url' => '/words', 'method' => 'get')) !!}
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <select name="category" class="form-control">
                                <option disabled selected value>{{ trans('message.select_category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-9">
                            <div class="col-md-5">
                                <label class="checkbox-inline">
                                    {{ Form::radio('learned', config('constants.LESSON_TESTED')) }} {{ trans('message.learned') }}
                                </label>
                            </div>
                            <div class="col-md-5">
                                <label class="checkbox-inline">
                                    {{ Form::radio('learned', config('constants.LESSON_UN_TESTED')) }} {{ trans('message.un_learned') }}
                                </label>
                            </div>
                            <div class="col-md-2">
                                {!! Form::submit('Search' , ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="table-responsive col-md-8 col-md-offset-2   ">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>{{ trans('message.index') }}</th>
                        <th>{{ trans('message.categories') }}</th>
                        <th>{{ trans('message.words') }}</th>
                        <th>{{ trans('message.learned') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($words as $key => $word)
                        @if ($learned == config('constants.LESSON_TESTED'))
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $word->category->name }}</td>
                                <td>{{ $word->text }}</td>
                                <td class="col-md-2">
                                    <span class="glyphicon glyphicon-check"></span>
                                </td>
                            </tr>
                        @elseif ($learned == config('constants.LESSON_UN_TESTED'))
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $word->category->name }}</td>
                                <td>{{ $word->text }}</td>
                                <td class="col-md-2">
                                    <span class="glyphicon glyphicon-unchecked"></span>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $word->category->name }}</td>
                                <td>{{ $word->text }}</td>
                                <td class="col-md-2">
                                    @if (!empty($word->user_words['0']))
                                        <span class="glyphicon glyphicon-check"></span>
                                    @else
                                        <span class="glyphicon glyphicon-unchecked"></span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                {{ $words->links() }}
            </div>
        </div>
    </div>
@stop
