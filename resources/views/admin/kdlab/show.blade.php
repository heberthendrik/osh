@extends('layouts.app')

@section('content')
<header class="page-header">
	<h2>Kode Lab</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.kdlab.index')}}">Kode Lab</a></li>
			<li><span>Detil</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<!-- start: page -->
<div class="row">
	<div class="col-lg-12">
		
		<section class="panel">
			<div class="panel-body">
				
				<div class="form-group">
					<div class="col-md-12 text-right">
						 <a href="javascript:;" data-toggle="modal" data-target="#input_detail" class="btn btn-sm btn-primary">Input N Rujukan</a>
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

				<h2 class="panel-title">Kode Lab</h2>
			</header>
			<div class="panel-body">
				@if($result->count())
                <table class="table table-bordered table-striped table-responsive">
                    <tr>
                        <th>Nama</th>
                        <td>{{$result->nama}}</td>
                        <th>Metoda</th>
                        <td>{{$result->metoda}}</td>
                    </tr>
                    <tr>
                        <th>Grup</th>
                        <td>{{$result->grup1}}</td>
                        <th>Status</th>
                        <td>{{$result->status}}</td>
                    </tr>
                </table>
                <br/>
                @if($result->nrujukan->count())
                <table class="table table-bordered table-striped table-responsive">
                    <thead>
                    <tr>
                        <th rowspan="2">Jenis Kelamin</th>
                        <th colspan="3">Usia</th>
                        <th rowspan="2">N Rujukan</th>
                        <th rowspan="2">Keterangan</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2"></th>
                    </tr>
                    <tr>
                        <th>Awal</th>
                        <th>Akhir</th>
                        <th>Satuan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result->nrujukan as $nrujukan)
                    <tr>
                        <td>{{ $nrujukan->sex }}</td>
                        <td>{{ $nrujukan->age_1 }}</td>
                        <td>{{ $nrujukan->age_2 }}</td>
                        <td>{{ $nrujukan->umur_sat }}</td>
                        <td>{{ $nrujukan->n_rujukan }}</td>
                        <td>{{ $nrujukan->ket }}</td>
                        <td>{{ $nrujukan->status }}</td>
                        <td>
                            {!! Former::open(route('settings.nrujukan.destroy', $nrujukan->id))->method('delete') !!}
                            <div class="btn-group">
                                <a class="btn btn-sm btn-default" href="{{route('settings.nrujukan.edit', $nrujukan->id)}}">Edit</a>
                                <a class="btn btn-sm btn-delete btn-danger" href="javascript:;" data-message="Anda akan menghapus data. Anda yakin?">Delete</a>
                            </div>
                            {!! Former::close() !!}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <i class="fa fa-fw fa-info-circle text-primary"></i> Belum ada hasil lab terdaftar.
                @endif
                @else
                <i class="fa fa-fw fa-info-circle text-primary"></i> Tidak Ada Data
                @endif
			</div>
		</section>                
	</div>
</div>


{{-- MODALS DETAIL --}}
<div class="modal fade" id="input_detail" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Input N Rujukan</h4>
            </div>
            {!! Former::open(route('settings.nrujukan.store'))->method('post') !!}
            <div class="modal-body">
                {!! Former::hidden('id_kdlab')->value($result->id)->required() !!}
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>
@endsection