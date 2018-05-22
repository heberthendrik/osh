@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Barang</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.barang.index')}}">Barang</a></li>
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
                {!! Former::populate($barang) !!}
                {!! Former::open(route('settings.barang.update', $barang->id))->method('put') !!}
                <div class="box-body">
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
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{route('settings.barang.index')}}" class="btn btn-default">Batal</a>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection