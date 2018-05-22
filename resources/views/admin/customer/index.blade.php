@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Pasien</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li class="active">Pasien</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pasien</h3>
                </div>
                <div class="box-body">
                    @if($customer->count())
                    @php $i=1; @endphp
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Rekam Medis</th>
                            <th>Rumah Sakit</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->alamat}}</td>
                            <td>{{$data->no_rm}}</td>
                            <td>
                                @if(isset($data->id_rs))
                                {{$data->hospital->nama}}
                                @endif
                            </td>
                            <td>
                                {!! Former::open(route('settings.customer.destroy', $data->id))->method('delete') !!}
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-default" href="{{route('settings.customer.edit', $data->id)}}">Edit</a>
                                    <a class="btn btn-sm btn-delete btn-danger" href="javascript:;" data-message="Anda akan menghapus data. Anda yakin?">Delete</a>
                                </div>
                                {!! Former::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <i class="fa fa-fw fa-info-circle text-primary"></i> Tidak Ada Data
                    @endif
                </div>
                <div class="box-footer">
                    <a href="{{route('settings.customer.create')}}" class="btn btn-primary">Input Data</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection