<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Main Navigation</li>
            <li class="{{Request::is('settings/ruang*')?'active':''}}"><a href="{{route('settings.ruang.index')}}"><i class="fa fa-fw fa-bed"></i> <span>Ruang</span></a></li>
            <li class="{{Request::is('settings/kelas*')?'active':''}}"><a href="{{route('settings.kelas.index')}}"><i class="fa fa-fw fa-file"></i> <span>Kelas</span></a></li>
            <li class="{{Request::is('settings/status*')?'active':''}}"><a href="{{route('settings.status.index')}}"><i class="fa fa-fw fa-file"></i> <span>Status</span></a></li>
            <li class="{{Request::is('settings/doctor*')?'active':''}}"><a href="{{route('settings.doctor.index')}}"><i class="fa fa-fw fa-user-md"></i> <span>Dokter</span></a></li>
            <li class="{{Request::is('settings/officer*')?'active':''}}"><a href="{{route('settings.officer.index')}}"><i class="fa fa-fw fa-user"></i> <span>Petugas</span></a></li>
            <li class="{{Request::is('settings/barang*')?'active':''}}"><a href="{{route('settings.barang.index')}}"><i class="fa fa-fw fa-medkit"></i> <span>Barang</span></a></li>
            <li class="{{Request::is('settings/customer*')?'active':''}}"><a href="{{route('settings.customer.index')}}"><i class="fa fa-fw fa-user"></i> <span>Pasien</span></a></li>

            <li class="header">Master</li>
            <li class="{{Request::is('settings/kdlab*')?'active':''}}"><a href="{{route('settings.kdlab.index')}}"><i class="fa fa-fw fa-file"></i> <span>Kode Lab</span></a></li>

            <li class="header">Settings</li>
            <li class="{{Request::is('settings/hospital*')?'active':''}}"><a href="{{route('settings.hospital.index')}}"><i class="fa fa-fw fa-hospital-o"></i> <span>Rumah Sakit</span></a></li>
            @if (Auth::user()->roles == 'superadmin')
            <li class="{{Request::is('settings/user*')?'active':''}}"><a href="{{route('settings.user.index')}}"><i class="fa fa-fw fa-user"></i> <span>User</span></a></li>
            <li class="{{Request::is('settings/slider*')?'active':''}}"><a href="{{route('settings.slider.index')}}"><i class="fa fa-fw fa-image"></i> <span>Slider</span></a></li>
            @endif
        </ul>
    </section>
</aside>