@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Pasien</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.customer.index')}}">Pasien</a></li>
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
                {!! Former::open(route('settings.customer.store'))->method('post') !!}
                <div class="box-body">
                    {!! Former::text('nama')->required() !!}
                    {!! Former::text('alamat')->required() !!}
                    {!! Former::text('no_rm')->label('No. Rekam Medis')->required() !!}
                    {!! Former::select('sex')->label('Jenis Kelamin')->options([
                    'L' => 'Laki-Laki',
                    'P' => 'Perempuan'
                    ])->required() !!}
                    {!! Former::date('tgl_lahir')->required() !!}
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
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{route('settings.customer.index')}}" class="btn btn-default">Batal</a>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection