@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Status</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.status.index')}}">Status</a></li>
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
                {!! Former::populate($status) !!}
                {!! Former::open(route('settings.status.update', $status->id))->method('put') !!}
                <div class="box-body">
                    {!! Former::text('nama')->label('Nama Status')->required() !!}
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
                    <a href="{{route('settings.status.index')}}" class="btn btn-default">Batal</a>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection