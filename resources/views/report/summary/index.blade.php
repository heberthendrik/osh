@extends('layouts.public')

@section('content')
<section class="content-header">
    <h1>
        Laporan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Laporan</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Filter</h4>
                </div>
                <div class="box-body">
                    {!! Former::open_vertical(route('result.summary.index'))->method('get') !!}
                    {!! Former::select('tahun')
                    ->label('')
                    ->class('form-control select2')
                    ->options(['' => 'Pilih Tahun'])
                    ->options($filters['tahun'])
                    !!}
                    {!! Former::text('no_lab')->label('')->placeholder('Masukkan No Lab') !!}
                    {!! Former::select('id_dokter')->label('')
                    ->class('form-control select2')->options(['' => 'Pilih Dr Pengirim'])->options($filters['id_dokter']) !!}
                    {!! Former::select('id_rs')->label('')
                    ->class('form-control select2')->options(['' => 'Pilih Rumah Sakit'])->options($filters['id_rs'])!!}

                    <button class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rekapitulasi</h3>
                </div>
                <!-- /.box-header -->
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
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-default" href="{{route('report.summary.show', $data->id)}}">View</a>
                                    @if($data->kd_acc)
                                    <a class="btn btn-sm btn-default" href="{{route('result.getPrint', $data->id)}}"><i class="fa fa-print"></i> Cetak</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <i class="fa fa-fw fa-info-circle text-primary"></i> Belum ada hasil lab terdaftar.
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection