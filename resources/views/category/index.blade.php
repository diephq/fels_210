@extends('layouts.master')

@section('content')
    <div class="container category">
        <div class="col-md-10 col-md-offset-1">
            <h1 class="page-header title">{{ trans('message.categories') }}</h1>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <ul class="list-group">
                @foreach($categories as $key => $category)    
                <li class="list-group-item list-item">
                    <a class='category-item' href="{{ route('category_detail', ['id' => $category->id]) }}">{{ $category->name }}</a>
                </li>
                @endforeach
                        
            </ul>
        </div>
    </div>
@stop
