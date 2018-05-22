@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Kode Lab</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li class="active">Kode Lab</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Kode Lab</h3>
                </div>
                <div class="box-body">
                    @if($kdlab->count())
                    @php $i=1; @endphp
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Grup</th>
                            <th>Metoda</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($kdlab as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->grup1}}</td>
                            <td>{{$data->metoda}}</td>
                            <td>{{$data->status}}</td>
                            <td>
                                {!! Former::open(route('settings.kdlab.destroy', $data->id))->method('delete') !!}
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-default" href="{{route('settings.kdlab.show', $data->id)}}">View</a>
                                    <a class="btn btn-sm btn-default" href="{{route('settings.kdlab.edit', $data->id)}}">Edit</a>
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
                    <a href="{{route('settings.kdlab.create')}}" class="btn btn-primary">Input Data</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection