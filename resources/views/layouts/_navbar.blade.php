<header class="main-header" style="max-height: 125px !important;">
    <nav class="navbar navbar-static-top">
        <div class="container-fluid device-lg visible-lg" style="height: 75px;background-color: white;">
            <div class="navbar-header">
                <a class="navbar-brand" href="/home" style="padding-top: 0">
                    <img src="{{asset('img/3271.png')}}">
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="navbar-header navbar-right">
                @if(!Auth::guest() && Auth::user()->id_rs)
                <a class="navbar-brand" href="{{ App\Models\Hospital::find(Auth::user()->id_rs)->link}}" style="padding-top: 0; ">
                    <img src="{{ asset('storage/'. App\Models\Hospital::find(Auth::user()->id_rs)->logo)}}" style="height: 72px;">
                </a>
                @endif
            </div>
        </div>

        <div class="container-fluid device-sm visible-sm device-xs visible-xs device-md visible-md" style="height: 75px;">
            <div class="navbar-header">
                <a class="navbar-brand" href="/home" style="padding-top: 0">
                    <img src="{{asset('img/3271.png')}}">
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>

        <div class="container-fluid">
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav ">
                    <li class="{{Request::is('home')?'active':''}}" title="New Lab Result"><a href="{{route('home')}}"><i class="fa fa-play-circle-o"></i></a></li>
                    @if (!Auth::guest())
                    <li class="{{Request::is('result*')?'active':''}}" title="Lab Result"><a href="{{route('result.summary.index')}}"><i class="fa fa-line-chart"></i></a></li>
                    <li class="dropdown" title="Report">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-pdf-o"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="{{Request::is('report/summary*')?'active':''}}"><a href="{{route('report.summary.index')}}">Rekapitulasi</a></li>
                            <li class="{{Request::is('report/visitByRoom*')?'active':''}}"><a href="{{route('report.visitByRoom.index')}}">Kunjungan Per Ruang</a></li>
                        </ul>
                    </li>
                    @if(Auth::user()->roles == 'admin' || Auth::user()->roles == 'superadmin')
                    <li title="Admin Panel"><a href="{{ route('settings.dashboard.index') }}"><i class="fa fa-bars"></i></a></li>
                    @endif
                    @endif
                    <li class="{{Request::is('dashboard')?'active':''}}" title="Dashboard"><a href="{{route('dashboard')}}"><i class="fa fa-pie-chart"></i></a></li>
                </ul>
            </div>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
<!--                    <form class="navbar-form navbar-left" role="search">-->
<!--                        <div class="form-group">-->
<!--                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">-->
<!--                        </div>-->
<!--                    </form>-->
                    @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Sign in</a></li>
                    @else
                    @include('layouts._notif')
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
        </div>


        <div class="container">

            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->

            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>