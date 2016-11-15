@extends('layouts.master')

@section('content')
    <div class="container">
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
            <ul class="list-group">
                <div class="table-responsive">
                    <table class="table">
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
                                    @if (!empty($word->results['0']))
                                        <td class="glyphicon glyphicon-check"></td>
                                    @else
                                        <td class="glyphicon glyphicon-unchecked"></td>
                                    @endif
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{ $words->links() }}
                </div>
            </ul>
        </div>
    </div>
@stop
