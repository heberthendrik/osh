@php
$notif = App\Models\Notification::where('receiver', Auth::user()->id)->where('read','0')->orderBy('created_at', 'desc');
@endphp

<!-- start: header -->
<header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <img src="{{ asset('hebert_admin/images/logo_revised.png') }}" height="35" alt="Logo Open Swelab"/>
        </a>

        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
             data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <form action="pages-search-results.html" class="search nav-form">
            <div class="input-group input-search">
                <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
            </div>
        </form>

        <span class="separator"></span>

        <ul class="notifications">
            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                    <i class="fa fa-tasks"></i>
                </a>

                <div class="dropdown-menu notification-menu large">
                    <div class="notification-title">
                        Progress
                    </div>

                    <div class="content">
                        <ul>
                            <li>
                                <p class="clearfix mb-xs">
                                    <span class="message pull-left">Approved Report</span>
                                    <span class="message pull-right text-dark">{{$data['resultComplete']}}%</span>
                                </p>

                                <div class="progress progress-xs light">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                         aria-valuemax="100" style="width: {{$data['resultComplete']}}%;"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                    <i class="fa fa-bell"></i>
                    <span class="badge">{{ $notif->count() }}</span>
                </a>

                <div class="dropdown-menu notification-menu">
                    <div class="notification-title">
                        <span class="pull-right label label-default">{{ $notif->count() }}</span>
                        Alerts
                    </div>

                    <div class="content">
                        <ul>
                            @foreach($notif->get() as $rd)
                            <li>
                                <a href="{{route('api.postStatus', $rd->id)}}" class="clearfix">
                                    <span class="title">{{$rd->text}}</span>
                                    <span class="message">Date: {{$rd->created_at->diffForHumans()}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>

                        <hr/>

                        <div class="text-right">
                            <a href="{{route('profile.show', Auth::user()->id)}}" class="view-more">View All</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">

                <figure class="profile-picture">
                    @if(Auth::user()->image)
                    <img src="{{asset('storage/'. Auth::user()->image)}}" class="user-image" class="img-circle"
                         alt="User Image">
                    @else
                    <img src="{{asset('adminlte/dist/img/avatar5.png')}}" class="user-image" class="img-circle"
                         alt="User Image">
                    @endif
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                    <span class="name">{{ Auth::user()->name }}</span>
                    <span class="role">{{ Auth::user()->roles }}</span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{route('profile.show', Auth::user()->id)}}"><i
                            class="fa fa-user"></i> My Profile</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i>
                            Lock Screen</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                            class="fa fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

        </div>
    </div>
    <!-- end: search & user box -->
</header>
<!-- end: header -->