<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    @section('css')
        {{ Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') }}
        {{ Html::style('assets/css/common.css') }}
    @show

</head>
<body id="app-layout">

        @include('layouts.header')

        <!-- include the alert template here -->
        
        <div class="content">
            @include('template.alert')
            @include('template.error')
            @yield('content')
        </div>

        @include('layouts.footer')

    @section('js')
        {{ Html::script('bower_components/jquery/dist/jquery.min.js') }}
        {{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
    @show
</body>
</html>
