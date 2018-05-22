@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Rumah Sakit
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li class="active">Rumah Sakit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rumah Sakit</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if($hospital->count())
                    @php $i=1; @endphp
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama RS</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hospital as $h)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$h->nama}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-default" href="{{route('settings.hospital.edit', $h->id)}}">Edit</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <i class="fa fa-fw fa-info-circle text-primary"></i> Tidak Ada Data
                    @endif
                </div>
                @if(Auth::user()->roles == 'superadmin')
                <div class="box-footer">
                    <a href="{{route('settings.hospital.create')}}" class="btn btn-primary">Input Data</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection