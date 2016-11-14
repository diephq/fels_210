<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{trans('message.project')}}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">{{ trans('message.login') }}</a></li>
                    <li><a href="{{ url('/register') }}">{{ trans('message.register') }}</a></li>
                @else
                    <li><a href="{{ route('categories') }}">{{ trans('message.categories') }}</a></li>
                    <li><a href="#">{{ trans('message.words' ) }}</a></li>
                    <li><a href="#">{{ trans('message.activities') }}</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/user/{{ Auth::user()->id }}" ><span class="glyphicon glyphicon-edit"></span> {{ trans('message.edit_profile') }}</a></li>
                            <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out"></span> {{ trans('message.logout') }}</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
