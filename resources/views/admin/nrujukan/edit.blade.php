@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>N Rujukan</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.kdlab.show', $nrujukan->id_kdlab)}}">N Rujukan</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Data</h3>
                </div>
                {!! Former::populate($nrujukan) !!}
                {!! Former::open(route('settings.nrujukan.update', $nrujukan->id))->method('put') !!}
                <div class="box-body">
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
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{route('settings.kdlab.show', $nrujukan->id_kdlab)}}" class="btn btn-default">Batal</a>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection