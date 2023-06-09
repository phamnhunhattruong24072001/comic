<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('admin.dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- sidebar menu -->
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('backend/production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::guard('admin')->user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li class=""><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>


                    <li><a><i class="fa fa-users"></i> {{ __('layout.admin.sidebar.manage_user') }} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @can(\App\Models\User::VIEW)
                            <li><a href="{{ route('admin.users.list') }}">{{ __('layout.admin.sidebar.list_user') }}</a></li>
                            @endcan
                        </ul>
                    </li>

                    <li><a><i class="fa fa-table"></i> {{ __('layout.admin.sidebar.manage_comic') }} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @can(\App\Models\Country::VIEW)
                            <li><a href="{{ route('admin.country.list') }}">{{ __('layout.admin.sidebar.manage_country') }}</a></li>
                            @endcan

                            @can(\App\Models\Category::VIEW)
                                <li><a href="{{ route('admin.category.list') }}">{{ __('layout.admin.sidebar.manage_category') }}</a></li>
                            @endcan

                            @can(\App\Models\Genre::VIEW)
                                <li><a href="{{ route('admin.genre.list') }}">{{ __('layout.admin.sidebar.manage_genre') }}</a></li>
                            @endcan

                            @can(\App\Models\Comic::VIEW)
                                <li><a href="{{ route('admin.comic.list') }}">{{ __('layout.admin.sidebar.manage_comic') }}</a></li>
                            @endcan

                            @can(\App\Models\Chapter::VIEW)
                                <li><a href="{{ route('admin.chapter.list') }}">{{ __('layout.admin.sidebar.manage_chapter') }}</a></li>
                            @endcan

                            @can(\App\Models\Figure::VIEW)
                                <li><a href="{{ route('admin.figure.list') }}">{{ __('layout.admin.sidebar.manage_figure') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" id="logout"
               data-url="{{ route('admin.logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>

        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
