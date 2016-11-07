@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>{{ trans('message.categories') }}</h1>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item"><a href="{{ route('category_detail', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@stop
