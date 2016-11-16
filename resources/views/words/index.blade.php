@extends('layouts.master')

@section('content')
    <div class="container category">
        <div class="row">
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
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label class="checkbox-inline">
                                {{ Form::checkbox('learned', config('constants.LESSON_TESTED')) }} {{ trans('message.learned') }}
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            </label>
                        </div>
                    </div>
                    {!! Form::submit('Search' , ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
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
                    @foreach($words as $word)
                        @if ($learned)
                            <tr>
                                @if (!empty($word->results['0']))
                                    <td>{{ $word->id }}</td>
                                    <td>{{ $word->category->name }}</td>
                                    <td>{{ $word->text }}</td>
                                    <td class="glyphicon glyphicon-check"></td>
                                @endif
                            </tr>
                        @else
                            <tr>
                                <td>{{ $word->id }}</td>
                                <td>{{ $word->category->name }}</td>
                                <td>{{ $word->text }}</td>
                                <td class="col-md-2">
                                    @if (!empty($word->results['0']))
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
