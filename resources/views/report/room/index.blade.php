@extends('layouts.public')

@section('content')
<header class="page-header">
	<h2>Laporan - Kunjungan Per Ruang</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
			<li><a href="#">Laporan</a></li>
			<li><span>Kunjungan Per Ruang</span></li>
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
                    {!! Former::open_vertical(route('report.visitByRoom.index'))->method('get') !!}
                    {!! Former::select('tahun')
                    ->label('')
                    ->placeholder('Pilih Tahun')
                    ->class('form-control select2')
                    ->options($filters['tahun'])
                    !!}

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
		
				<h2 class="panel-title">Kunjungan Per Ruang</h2>
			</header>
			<div class="panel-body">
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
		</section>
	</div>	
</div>
@endsection