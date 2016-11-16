@extends('layouts.master')

@section('content')
    <div class="container category">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="page-header">{{ trans('message.categories') }}</h1>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>{{ trans('message.id') }}</th>
                    <th>{{ trans('message.name') }}</th>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><a href="{{ route('category_detail', ['id' => $category->id]) }}">{{ $category->name }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
