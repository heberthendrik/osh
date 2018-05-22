@extends('layouts.app')

@section('content')
<header class="page-header">
	<h2>Barang</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.barang.index')}}">Barang</a></li>
			<li><span>Tambah</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<!-- start: page -->
<div class="row">
	<div class="col-lg-12">
		
		{!! Former::open(route('settings.barang.store'))->method('post') !!}
			<section class="panel">
				<div class="panel-body">
					
					<div class="form-group">
						<div class="col-md-12 text-right">
							<a href="{{route('settings.barang.index')}}"><button type="button" class="btn btn-default">Batal</button></a>
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
	
					{!! Former::text('name')->label('Nama Barang')->required() !!}
                    {!! Former::select('id_satuan')
                    ->label('Satuan')
                    ->fromQuery(App\Models\Satuan::where('status', '1')->get(), 'nm_satuan', 'id')->required() !!}
                    {!! Former::text('katalog')->required() !!}
                    {!! Former::select('id_kategori')
                    ->label('Kategori')
                    ->fromQuery(App\Models\Kategori::where('status', '1')->get(), 'nama', 'id')->required() !!}
                    {!! Former::text('id_supplier')->required() !!}
                    {!! Former::text('tgl_masuk')->required() !!}
                    {!! Former::select('id_merk')
                    ->label('Merk')
                    ->options(['' => '-- Pilih --'])
                    ->fromQuery(App\Models\Merk::where('status', '1')->get(), 'nama', 'id') !!}
                    {!! Former::text('tipe')->required() !!}
                    {!! Former::text('id_principal')->required() !!}
                    {!! Former::number('hrg_perolehan')->required() !!}
                    {!! Former::number('hrg_jual')->required() !!}
                    {!! Former::select('status')->options([
                    '1' => 'Aktif',
                    '0' => 'Tidak Aktif'
                    ])->required() !!}
                    {!! Former::text('komputer')->required() !!}
                    {!! Former::text('user')->required() !!}
                    {!! Former::text('tgl_entri')->required() !!}
                    {!! Former::number('diskonv')->required() !!}
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