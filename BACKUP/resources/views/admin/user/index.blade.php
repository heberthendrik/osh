@extends('layouts.app')

@section('content')
<header class="page-header">
	<h2>User</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
			<li><span>User</span></li>
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
			<a href="{{route('settings.user.create')}}"><button class="btn btn-primary">Input Data <i class="fa fa-plus"></i></button></a>
		</div>

		<h2 class="panel-title">Master Data</h2>
	</header>
	<div class="panel-body">
		<div class="box-body">
            @if($user->count())
            @php $i=1; @endphp
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>
                        {!! Former::open(route('settings.user.destroy', $data->id))->method('delete') !!}
                        <div class="btn-group">
                            <a class="btn btn-sm btn-default" href="{{route('settings.user.edit', $data->id)}}">Edit</a>
                            <a class="btn btn-sm btn-delete btn-danger" href="javascript:;" data-message="Anda akan menghapus data. Anda yakin?">Delete</a>
                        </div>
                        {!! Former::close() !!}
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