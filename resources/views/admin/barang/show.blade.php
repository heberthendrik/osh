@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Barang</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.barang.index')}}">Barang</a></li>
        <li class="active">Detil</li>
    </ol>
</section>

<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                {{$barang->name}}
            </h2>
        </div>
    </div>
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
<div class="clearfix"></div>
@endsection