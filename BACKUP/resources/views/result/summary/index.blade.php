@extends('layouts.public')

@section('content')
<header class="page-header">
	<h2>Hasil Lab</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
			<li><span>Hasil Lab</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<div class="row">
	<div class="col-md-3 col-lg-3 col-xl-3">
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions" style="display:block;">
					<a href="#" style="display:none;" class="panel-action panel-action-toggle" data-panel-toggle></a>
					<a href="#" style="display:none;" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
				</div>
		
				<h2 class="panel-title">Filter</h2>
			</header>
			<div class="panel-body">
				<div class="box-body">
                    {!! Former::open_vertical(route('result.summary.index'))->method('get') !!}
                    {!! Former::select('tahun')
                    ->label('')
                    ->class('form-control select2')
                    ->options(['' => 'Pilih Tahun'])
                    ->options($filters['tahun'])
                    !!}
                    {!! Former::text('no_lab')->label('')->placeholder('Masukkan No Lab') !!}
                    {!! Former::select('id_dokter')
                    ->label('')
                    ->class('form-control select2')
                    ->options(['' => 'Pilih Dr Pengirim'])
                    ->options($filters['id_dokter']) !!}
                    {!! Former::select('id_rs')
                    ->label('')
                    ->class('form-control select2')
                    ->options(['' => 'Pilih Rumah Sakit'])
                    ->options($filters['id_rs'])!!}

                    <button class="btn btn-primary" style="width:100%;margin-top:15px;"><i class="fa fa-filter"></i> Filter</button>
                    {!! Former::close() !!}
                </div>
			</div>
		</section>
	</div>
	<div class="col-md-9 col-lg-9 col-xl-9">
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions" style="display:block;">
					<a href="#" style="display:none;" class="panel-action panel-action-toggle" data-panel-toggle></a>
					<a href="#" style="display:none;" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
				</div>
		
				<h2 class="panel-title">Hasil Lab</h2>
			</header>
			<div class="panel-body">
				<div class="box-body">
                    @if($result->count())
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Lab</th>
                            <th>No. Rekam Medis</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Proses Validasi</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($result as $data)
                        <tr>
                            <td>{{ date('d F Y', strtotime($data->created_at)) }}</td>
                            <td>{{$data->no_lab}}</td>
                            <td>{{$data->no_rm}}</td>
                            <td>{{$data->nama}}</td>
                            <td>@if(isset($data->tgl_lahir))
                                {{ date('d F Y', strtotime($data->tgl_lahir)) }}
                                @endif
                            </td>
                            <td>{{ $data->details->where('kd_acc','1')->count()}} / {{ $data->details->count()}}</td>
                            <td>
                                {!! Former::open(route('result.summary.destroy', $data->id))->method('delete') !!}
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-default"
                                       href="{{route('result.summary.show', $data->id)}}">View</a>
                                    @if(Auth::user()->roles == 'doctor')
                                    @if(!$data->kd_acc)
                                    <a class="btn btn-sm btn-success" href="{{route('result.getValidate', $data->id)}}">Validasi</a>
                                    @else
                                    <a class="btn btn-sm btn-danger"
                                       href="{{route('result.getUnvalidate', $data->id)}}">Batalkan Validasi</a>
                                    @endif
                                    @elseif(Auth::user()->roles == 'officer' && $data->kd_acc != '1')
                                    <a class="btn btn-sm btn-delete btn-danger" href="javascript:;"
                                       data-message="Anda akan menghapus data. Anda yakin?">Delete</a>
                                    @endif
                                    @if($data->kd_acc)
                                    <a class="btn btn-sm btn-default" href="{{route('result.getPrint', $data->id)}}"><i
                                        class="fa fa-print"></i> Cetak</a>
                                    @endif
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
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    @if(Auth::user()->roles == 'officer')
                    <a href="{{route('result.summary.create')}}" class="btn btn-primary">Input Pemeriksaan</a>
                    @endif
                </div>
			</div>
		</section>
	</div>	
</div>
@endsection
