@extends('layouts.app')

@section('content')

<header class="page-header">
	<h2>Ruang</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
			<li><a href="{{route('settings.ruang.index')}}">Ruang</a></li>
			<li><span>Edit</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>


<!-- start: page -->
<div class="row">
	<div class="col-lg-12">
		
		{!! Former::populate($ruang) !!}
		{!! Former::open(route('settings.ruang.update', $ruang->id))->method('put') !!}
			<section class="panel">
				<div class="panel-body">
					
					<div class="form-group">
						<div class="col-md-12 text-right">
							<a href="{{route('settings.ruang.index')}}"><button type="button" class="btn btn-default">Batal</button></a>
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
	
					<style>
						.required{
							display:inherit;
						}
						label{
							color:#777;
							font-size:13px;
						}
						label sup{
							color:red;
							font-size:13px;
							padding-left:5px;
						}
						select, .select2-selection__rendered, input{
							font-size:13px!important;
							font-weight:normal!important;
						}
						
						.select2-selection{
							height:35px!important;
						}
					</style>
					
					{!! Former::text('nama')->label('Nama Ruang')->required() !!}
                    {!! Former::select('status')->options([
                    '1' => 'Aktif',
                    '0' => 'Tidak Aktif'
                    ])->required() !!}
                    {!! Former::select('id_rs')
                    ->label('Rumah Sakit')
                    ->class('form-control select2')
                    ->options($filters['id_rs'])
                    ->required() !!}
                    
                    
                    
					
                    
	
				</div>
			</section>
		{!! Former::close() !!}
		
		

	</div>
</div>
<!-- end: page -->
@endsection