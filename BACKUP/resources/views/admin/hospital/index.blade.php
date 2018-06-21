@extends('layouts.app')

@section('content')
<header class="page-header">
	<h2>Rumah Sakit</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
			<li><span>Rumah Sakit</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<!-- start: page -->
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions" style="display:block;">
			<a href="#" style="display:none;" class="panel-action panel-action-toggle" data-panel-toggle></a>
			<a href="#" style="display:none;" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
			@if(Auth::user()->roles == 'superadmin')
			<a href="{{route('settings.hospital.create')}}"><button class="btn btn-primary">Input Data <i class="fa fa-plus"></i></button></a>
			@endif
		</div>

		<h2 class="panel-title">Master Data</h2>
	</header>
	<div class="panel-body">
		<div class="box-body">
            @if($hospital->count())
            @php $i=1; @endphp
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama RS</th>
                    <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hospital as $h)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$h->nama}}</td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-sm btn-default" href="{{route('settings.hospital.edit', $h->id)}}">Edit</a>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <i class="fa fa-fw fa-info-circle text-primary"></i> Tidak Ada Data
            @endif
        </div>    
	</div>
</section>
<!-- end: page -->
		
@endsection