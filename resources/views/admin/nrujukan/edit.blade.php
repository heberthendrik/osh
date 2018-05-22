@extends('layouts.app')

@section('content')
<header class="page-header">
	<h2>N Rujukan</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.kdlab.show', $nrujukan->id_kdlab)}}">N Rujukan</a></li>
			<li><span>Edit</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>


<!-- start: page -->
<div class="row">
	<div class="col-lg-12">
		
		{!! Former::populate($nrujukan) !!}
		{!! Former::open(route('settings.nrujukan.update', $nrujukan->id))->method('put') !!}
			<section class="panel">
				<div class="panel-body">
					
					<div class="form-group">
						<div class="col-md-12 text-right">
							<a href="{{route('settings.kdlab.show', $nrujukan->id_kdlab)}}" class="btn btn-default">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
	
				</div>
			</section>
			
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
					</div>
	
					<h2 class="panel-title">Edit Data</h2>
				</header>
				<div class="panel-body">
	
					{!! Former::hidden('id_kdlab')->value($nrujukan->id_kdlab)->required() !!}
                    {!! Former::select('sex')->label('Jenis Kelamin')->options([
                    '' => 'Pilih Data',
                    'L' => 'Laki-Laki',
                    'P' => 'Perempuan'
                    ]) !!}
                    {!! Former::text('age_1')->required() !!}
                    {!! Former::text('age_2')->required() !!}
                    {!! Former::select('umur_sat')->label('Umur Satuan')->options([
                    'Hari' => 'Hari',
                    'Bulan' => 'Bulan',
                    'Tahun' => 'Tahun'
                    ])->required() !!}
                    {!! Former::text('nr_1')->required() !!}
                    {!! Former::text('nr_2')->required() !!}
                    {!! Former::text('n_rujukan')->required() !!}
                    {!! Former::text('urut')->required() !!}
                    {!! Former::text('ket')->required() !!}
                    {!! Former::select('status')->options([
                    '1' => 'Aktif',
                    '0' => 'Tidak Aktif'
                    ])->required() !!}
                    
				</div>
			</section>
		{!! Former::close() !!}
		
		

	</div>
</div>
<!-- end: page -->
@endsection