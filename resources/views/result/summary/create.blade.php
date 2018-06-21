@extends('layouts.public')

@section('content')
<header class="page-header">
    <h2>Hasil Lab</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li><a href="#"><i class="fa fa-gears"></i> Beranda</a></li>
            <li><a href="{{route('result.summary.index')}}">Hasil Lab</a></li>
            <li><span>Tambah</span></li>
        </ol>

        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>

<!-- start: page -->
<div class="row">
    <div class="col-lg-12">

        {!! Former::open(route('result.summary.store'))->method('post') !!}

        <section class="panel">
            <div class="panel-body">

                <div class="form-group">
                    <div class="col-md-12 text-right">
                        <a href="{{route('result.summary.index')}}">
                            <button type="button" class="btn btn-default">Batal</button>
                        </a>
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
                <div class="box-body">
                    <div class="col-md-6">
                        {!! Former::date('tanggal')->value(date('Y-m-d'))->disabled()->required() !!}
                        {!! Former::text('no_rm')->label('No. Rekam Medis')->required() !!}
                        {!! Former::text('nama')->required() !!}
                        {!! Former::date('tgl_lahir')->required() !!}
                        {!! Former::select('sex')->label('Jenis Kelamin')
                        ->class('form-control select2')
                        ->options([
                        'L' => 'Laki-Laki',
                        'P' => 'Perempuan'
                        ])->required() !!}
                        {!! Former::text('alamat')->required() !!}
                        {!! Former::select('id_ruang')
                        ->label('Ruang')
                        ->class('form-control select2')
                        ->options($filters['id_ruang'])
                        ->required() !!}
                        {!! Former::select('id_kelas')
                        ->label('Kelas')
                        ->class('form-control select2')
                        ->options(['' =>'Pilih Data'])
                        ->options($filters['id_kelas']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Former::select('id_status')
                        ->label('Status')
                        ->class('form-control select2')
                        ->options($filters['id_status'])
                        ->required() !!}
                        {!! Former::select('id_dokter')
                        ->label('Dr Pengirim')
                        ->class('form-control select2')
                        ->options($filters['id_dokter'])
                        ->required() !!}
                        {!! Former::text('alamat_dokter')->maxlength('200') !!}
                        {!! Former::text('ket_klinik')->maxlength('200') !!}
                        {!! Former::text('catatan_1')->maxlength('200') !!}
                        {!! Former::text('catatan_2')->maxlength('200') !!}
                        {!! Former::select('id_rs')
                        ->label('Rumah Sakit')
                        ->class('form-control select2')
                        ->options($filters['id_rs'])
                        ->required() !!}
                    </div>
                    {!! Former::hidden('id_pengentri')->value(Auth::user()->id)->required() !!}
                    {!! Former::hidden('nm_pengentri')->value(Auth::user()->name)->required() !!}
                </div>
            </div>
        </section>

        {!! Former::close() !!}

    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/result/index.js')}}"
@endsection