@extends('layouts.app')

@section('content')
<header class="page-header">
	<h2>Kode Lab</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
			<li><span>Kode Lab</span></li>
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
			<a href="{{route('settings.kdlab.create')}}"><button class="btn btn-primary">Input Data <i class="fa fa-plus"></i></button></a>
		</div>

		<h2 class="panel-title">Master Data</h2>
	</header>
	<div class="panel-body">
		<div class="box-body">
            @if($kdlab->count())
            @php $i=1; @endphp
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Grup</th>
                    <th>Metoda</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kdlab as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->grup1}}</td>
                    <td>{{$data->metoda}}</td>
                    <td>{{$data->status}}</td>
                    <td>
                        {!! Former::open(route('settings.kdlab.destroy', $data->id))->method('delete') !!}
                        <div class="btn-group">
                            <a class="btn btn-sm btn-default" href="{{route('settings.kdlab.show', $data->id)}}">View</a>
                            <a class="btn btn-sm btn-default" href="{{route('settings.kdlab.edit', $data->id)}}">Edit</a>
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