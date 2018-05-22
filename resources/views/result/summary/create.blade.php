@extends('layouts.public')

@section('content')
<section class="content-header">
    <h1>Hasil Lab</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="{{route('result.summary.index')}}">Hasil Lab</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Input Data</h3>
                </div>
                {!! Former::open(route('result.summary.store'))->method('post') !!}
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
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{route('result.summary.index')}}" class="btn btn-default">Batal</a>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection
