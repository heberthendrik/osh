<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-dashboard"></i></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><i class="fa fa-dashboard"></i> {{ config('app.name', 'Laravel') }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (Auth::guest())
                <li><a href="{{ route('login') }}">Sign in</a></li>
                @else
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::user()->image)
                        <img src="{{asset('storage/'. Auth::user()->image)}}" class="user-image"  alt="User Image">
                        @else
                        <img src="{{asset('adminlte/dist/img/avatar5.png')}}" class="user-image" alt="User Image">
                        @endif
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            @if(Auth::user()->image)
                            <img src="{{asset('storage/'. Auth::user()->image)}}" class="img-circle"  alt="User Image">
                            @else
                            <img src="{{asset('adminlte/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
                            @endif
                            <p>
                                {{ Auth::user()->name }}
                                <small>Member since {{ date('F Y', strtotime(Auth::user()->created_at)) }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('profile.show', Auth::user()->id)}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>