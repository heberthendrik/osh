@extends('layouts.public')

@section('content')
<section class="content-header">
    <h1>
        Laporan
        <small>Kunjungan Per Ruang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a>
        <li><a href="#">Laporan</a></li>
        <li class="active">Kunjungan Per Ruang</li>
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
                    {!! Former::open_vertical(route('report.visitByRoom.index'))->method('get') !!}
                    {!! Former::select('tahun')
                    ->label('')
                    ->placeholder('Pilih Tahun')
                    ->class('form-control select2')
                    ->options($filters['tahun'])
                    !!}

                    <button class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Kunjungan Per Ruang</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if($result->count())
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Ruang</th>
                            <th>Jumlah</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @foreach($result as $r)
                        <tr>
                            <td>{{$r->nm_ruang}}</td>
                            <td>{{$r->jml_ruang}}</td>
                        </tr>
                        @php
                        $total += $r->jml_ruang;
                        @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Jumlah</th>
                            <th>{{$total}}</th>
                        </tr>
                        </tfoot>
                    </table>
                    @else
                    <i class="fa fa-fw fa-info-circle text-primary"></i> Data Tidak Ditemukan.
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection