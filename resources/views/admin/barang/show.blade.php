@extends('layouts.app')

@section('content')
<header class="page-header">
	<h2>Barang</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.barang.index')}}">Barang</a></li>
			<li><span>Detil</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
					<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
				</div>

				<h2 class="panel-title">{{$barang->name}}</h2>
			</header>
			<div class="panel-body">
			
			<section class="invoice">
			    @if($barang->count())
			    <div class="row">
			        <div class="col-md-12">
			            <table class="table table-striped table-responsive">
			                <tr>
			                    <th>Nama Barang</th>
			                    <td>:</td>
			                    <td>{{$barang->name}}</td>
			                    <th>Principal</th>
			                    <td>:</td>
			                    <td>{{$barang->id_principal}}</td>
			                </tr>
			                <tr>
			                    <th>Satuan</th>
			                    <td>:</td>
			                    <td>{{$barang->id_satuan}}</td>
			                    <th>Harga Perolehan</th>
			                    <td>:</td>
			                    <td align="right">{{number_format($barang->hrg_perolehan, 0, ',', '.')}}</td>
			                </tr>
			                <tr>
			                    <th>Katalog</th>
			                    <td>:</td>
			                    <td>{{$barang->katalog}}</td>
			                    <th>Harga Jual</th>
			                    <td>:</td>
			                    <td align="right">{{number_format($barang->hrg_jual, 0, ',', '.')}}</td>
			                </tr>
			                <tr>
			                    <th>Kategori</th>
			                    <td>:</td>
			                    <td>@if(isset($barang->id_kategori))
			                        {{$barang->kategori->nama}}
			                        @endif
			                    </td>
			                    <th>Status</th>
			                    <td>:</td>
			                    <td>{{$barang->status}}</td>
			                </tr>
			                <tr>
			                    <th>Supplier</th>
			                    <td>:</td>
			                    <td>{{$barang->id_supplier}}</td>
			                    <th>Komputer</th>
			                    <td>:</td>
			                    <td>{{$barang->komputer}}</td>
			                </tr>
			                <tr>
			                    <th>Tanggal Masuk</th>
			                    <td>:</td>
			                    <td>{{$barang->tgl_masuk}}</td>
			                    <th>User</th>
			                    <td>:</td>
			                    <td>{{$barang->user}}</td>
			                </tr>
			                <tr>
			                    <th>Merk</th>
			                    <td>:</td>
			                    <td>{{$barang->id_merk}}</td>
			                    <th>Tanggal Entri</th>
			                    <td>:</td>
			                    <td>{{$barang->tgl_entri}}</td>
			                </tr>
			                <tr>
			                    <th>Tipe</th>
			                    <td>:</td>
			                    <td>{{$barang->tipe}}</td>
			                    <th>Diskon</th>
			                    <td>:</td>
			                    <td align="right">{{number_format($barang->diskonv, 0, ',', '.')}}</td>
			                </tr>
			            </table>
			        </div>
			    </div>
			    @else
			    <i class="fa fa-fw fa-info-circle text-primary"></i> Data Tidak Ditemukan
			    @endif
			</section>
			
			</div>
		</section>
	</div>
</div>
@endsection