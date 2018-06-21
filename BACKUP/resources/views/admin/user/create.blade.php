@extends('layouts.app')

@section('content')
<header class="page-header">
	<h2>User</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.user.index')}}">User</a></li>
			<li><span>Tambah</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<!-- start: page -->
<div class="row">
	<div class="col-lg-12">
		
		{!! Former::open(route('settings.user.store'))->method('post') !!}
			<section class="panel">
				<div class="panel-body">
					
					<div class="form-group">
						<div class="col-md-12 text-right">
							<a href="{{route('settings.user.index')}}"><button type="button" class="btn btn-default">Batal</button></a>
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
	
					<h2 class="panel-title">Input Data</h2>
				</header>
				<div class="panel-body">
	
					{!! Former::text('name')->required() !!}
                    {!! Former::text('email')->required() !!}
                    {!! Former::password('password')->required() !!}
                    {!! Former::select('roles')->options([
                    'admin' => 'Admin',
                    'user' => 'Doctor',
                    'officer' => 'Officer'
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