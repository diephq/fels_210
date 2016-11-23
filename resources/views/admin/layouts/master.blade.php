<!DOCTYPE html>
<html>
<head>
    <title>E-learning</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans('message.project') }}</title>

    @section('css')
        {{ Html::style('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}
        {{ Html::link('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css', '') }}
        {{ Html::style('bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}
        {{ Html::style('bower_components/AdminLTE/dist/css/skins/_all-skins.min.css') }}
        {{ Html::style('bower_components/AdminLTE/plugins/iCheck/flat/blue.css') }}
        {{ Html::style('bower_components/AdminLTE/plugins/morris/morris.css') }}
        {{ Html::style('bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}
        {{ Html::style('bower_components/AdminLTE/plugins/datepicker/datepicker3.css') }}
        {{ Html::style('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}
        {{ Html::style('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}
        {{ Html::style('assets/css/admin.css') }}
    @show

</head>

<body class="hold-transition skin-blue sidebar-mini">
@section('header_admin')
    <div class="wrapper">

        @include('admin.layouts.header')

        <div class="content-wrapper">
            <section class="content">

                @include('template.alert')

                @yield('content')

            </section>
        </div>

        @include('admin.layouts.footer')

    </div>
@show

@section('js')
    {{ Html::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}
    {{ Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}
    {{ Html::script('bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}
    {{ Html::script('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}
    {{ Html::script('bower_components/AdminLTE/dist/js/app.min.js') }}
    {{ Html::script('bower_components/AdminLTE/dist/js/demo.js') }}
</body>
@show
</html>
