<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-lg"><b>{{ trans('message.admin.site') }}</b></span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::user())
                            <img src="{{ Auth::user()->avatar }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        @endif

                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            @if (Auth::user())
                            <img src="{{ Auth::user()->avatar }}" class="img-circle image_size" alt="User Image">
                            @endif
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat">{{ trans('message.logout') }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">{{ trans('message.main') }}</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>{{ trans('message.user') }}</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="#"><i class="fa fa-circle-o"></i>{{ trans('message.list_user') }}</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>{{ trans('message.create_user') }}</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>{{ trans('message.categories') }}</span>
                    <span class="pull-right-container"><span class="label label-primary pull-right"></span></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/category"><i class="fa fa-circle-o"></i>{{ trans('message.list_categories') }}</a></li>
                    <li><a href="/admin/category/create"><i class="fa fa-circle-o"></i>{{ trans('message.create_category') }}</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
