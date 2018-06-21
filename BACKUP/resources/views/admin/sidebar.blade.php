<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
                    <li class="{{Request::is('settings/dashboard*')?'nav-active':''}}">
						<a href="{{route('settings.dashboard.index')}}">
							<i class="fa fa-home" aria-hidden="true"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<li class="{{Request::is('settings/ruang*')?'nav-active':''}}">
						<a href="{{route('settings.ruang.index')}}">
							<i class="fa fa-fw fa-bed" aria-hidden="true"></i>
							<span>Ruang</span>
						</a>
					</li>
					<li class="{{Request::is('settings/kelas*')?'nav-active':''}}">
						<a href="{{route('settings.kelas.index')}}">
							<i class="fa fa-fw fa-file" aria-hidden="true"></i>
							<span>Kelas</span>
						</a>
					</li>
					<li class="{{Request::is('settings/status*')?'nav-active':''}}">
						<a href="{{route('settings.status.index')}}">
							<i class="fa fa-fw fa-file" aria-hidden="true"></i>
							<span>Status</span>
						</a>
					</li>
					<li class="{{Request::is('settings/doctor*')?'nav-active':''}}">
						<a href="{{route('settings.doctor.index')}}">
							<i class="fa fa-fw fa-user-md" aria-hidden="true"></i>
							<span>Dokter</span>
						</a>
					</li>
					<li class="{{Request::is('settings/officer*')?'nav-active':''}}">
						<a href="{{route('settings.officer.index')}}">
							<i class="fa fa-fw fa-user" aria-hidden="true"></i>
							<span>Petugas</span>
						</a>
					</li>
					<li class="{{Request::is('settings/barang*')?'nav-active':''}}">
						<a href="{{route('settings.barang.index')}}">
							<i class="fa fa-fw fa-medkit" aria-hidden="true"></i>
							<span>Barang</span>
						</a>
					</li>
					<li class="{{Request::is('settings/customer*')?'nav-active':''}}">
						<a href="{{route('settings.customer.index')}}">
							<i class="fa fa-fw fa-user" aria-hidden="true"></i>
							<span>Pasien</span>
						</a>
					</li>
					<li class="{{Request::is('settings/kdlab*')?'nav-active':''}}">
						<a href="{{route('settings.kdlab.index')}}">
							<i class="fa fa-fw fa-file" aria-hidden="true"></i>
							<span>Kode Lab</span>
						</a>
					</li>
					<li class="{{Request::is('settings/hospital*')?'nav-active':''}}">
						<a href="{{route('settings.hospital.index')}}">
							<i class="fa fa-fw fa-hospital-o" aria-hidden="true"></i>
							<span>Rumah Sakit</span>
						</a>
					</li>
					@if (Auth::user()->roles == 'superadmin')
					<li class="{{Request::is('settings/user*')?'nav-active':''}}">
						<a href="{{route('settings.user.index')}}">
							<i class="fa fa-fw fa-user" aria-hidden="true"></i>
							<span>User</span>
						</a>
					</li>
					<li class="{{Request::is('settings/slider*')?'active':''}}">
						<a href="{{route('settings.slider.index')}}">
							<i class="fa fa-fw fa-image" aria-hidden="true"></i>
							<span>Slider</span>
						</a>
					</li>
					@endif
					<!--
					<li>
						<a href="pages-log-viewer.html">
							<i class="fa fa-cogs" aria-hidden="true"></i>
							<span>System Log</span>
						</a>
					</li>
					-->
				</ul>
			</nav>

		</div>

		<script>
			// Maintain Scroll Position
			if (typeof localStorage !== 'undefined') {
				if (localStorage.getItem('sidebar-left-position') !== null) {
					var initialPosition = localStorage.getItem('sidebar-left-position'),
						sidebarLeft = document.querySelector('#sidebar-left .nano-content');
					
					sidebarLeft.scrollTop = initialPosition;
				}
			}
		</script>

	</div>

</aside>
<!-- end: sidebar -->