<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="{{ asset('hebert_admin/images/logo_revised.png') }}" height="35" alt="Logo Open Swelab" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<div class="userbox">
					@if(!Auth::guest() && Auth::user()->id_rs)
		                <a class="navbar-brand" href="{{ App\Models\Hospital::find(Auth::user()->id_rs)->link}}" style="padding-top: 0; ">
		                    <img src="{{ asset('storage/'. App\Models\Hospital::find(Auth::user()->id_rs)->logo)}}" style="height: 72px;">
		                </a>
	                @else
	                	<a href="#">
							<img src="{{ asset('hebert_admin/images/logo_eka.png') }}" class="img-responsive" style="height:50px;">
	                	</a>
	                @endif
					</div>
			
					<span class="separator"></span>
					
					<ul class="notifications">
						
						<li class="{{Request::is('home')?'active':''}}" title="New Lab Result">
							<a href="{{route('home')}}" class="dropdown-toggle notification-icon" ><i class="fa fa-play-circle-o"></i></a>
						</li>
						
						@if (!Auth::guest())
						<li class="{{Request::is('result*')?'active':''}}" title="Lab Result">
							<a href="{{route('result.summary.index')}}" class="dropdown-toggle notification-icon" ><i class="fa fa-line-chart"></i></a>
						</li>
						<li class="dropdown" title="Report">
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown" ><i class="fa fa-file-pdf-o"></i></a>
							<ul class="dropdown-menu" role="menu">
	                            <li class="{{Request::is('report/summary*')?'active':''}}"><a href="{{route('report.summary.index')}}">Rekapitulasi</a></li>
	                            <li class="{{Request::is('report/visitByRoom*')?'active':''}}"><a href="{{route('report.visitByRoom.index')}}">Kunjungan Per Ruang</a></li>
	                        </ul>
						</li>						
		                    @if(Auth::user()->roles == 'admin' || Auth::user()->roles == 'superadmin')
			                    <li title="Admin Panel">
			                    	<a href="{{ route('settings.dashboard.index') }}" class="dropdown-toggle notification-icon" ><i class="fa fa-bars"></i></a>
			                    </li>
							@endif
						@endif
						<li class="{{Request::is('dashboard')?'active':''}}" title="Dashboard">
							<a href="{{route('dashboard')}}" class="dropdown-toggle notification-icon" ><i class="fa fa-pie-chart"></i></a>
						</li>
						
					</ul>
			
					<span class="separator"></span>
					
					@include('layouts._notif')
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
						
							<figure class="profile-picture">
								@if(Auth::user()->image)
	                            <img src="{{asset('storage/'. Auth::user()->image)}}" class="user-image" class="img-circle"  alt="User Image">
	                            @else
	                            <img src="{{asset('adminlte/dist/img/avatar5.png')}}" class="user-image" class="img-circle" alt="User Image">
	                            @endif
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">{{ Auth::user()->name }}</span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="{{route('profile.show', Auth::user()->id)}}"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" ><i class="fa fa-power-off"></i> Logout</a>
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
			