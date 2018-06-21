@extends('layouts.public')

@section('content')
<div class="container" style="margin-top: 7.5em;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title"><i class="fa fa-fw icon-pencil"></i> Edit Hasil Lab</h1>
        </div>
        {!! Former::populate($resultdetail) !!}
        {!! Former::open(route('result.detail.update', $resultdetail->id))->method('put') !!}
        <div class="panel-body">
            {!! Former::text('id_master')->readonly()->required() !!}
            {!! Former::select('id_lab')
            ->label('Kode Lab')
            ->class('form-control select2')
            ->fromQuery(App\Models\Kdlab::where('status', '1')->where('id', $resultdetail->id_lab)->orderBy('id','ASC')->get(), 'nama', 'id')->required() !!}
            {!! Former::text('hasil')->required() !!}
            {!! Former::text('rujukan_awal')->required() !!}
            {!! Former::text('rujukan_akhir')->required() !!}
            {!! Former::text('satuan') !!}
            {!! Former::text('metoda') !!}
            {!! Former::select('flag')->options([
            '0' => 'Normal',
            '4' => '<=',
            '5' => '>='
            ])->required() !!}
        </div>
        <div class="panel-footer">
            <button class="btn btn-outline btn-success">Simpan</button>
            <a href="{{route('result.summary.show', $resultdetail->id_master)}}" class="btn btn-outline btn-default">Batal</a>
        </div>
        {!! Former::close() !!}
    </div>
</div>
@endsection