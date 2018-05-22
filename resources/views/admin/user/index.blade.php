@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>User</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li class="active">User</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">User</h3>
                </div>
                <div class="box-body">
                    @if($user->count())
                    @php $i=1; @endphp
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>
                                {!! Former::open(route('settings.user.destroy', $data->id))->method('delete') !!}
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-default" href="{{route('settings.user.edit', $data->id)}}">Edit</a>
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
                    <a href="{{route('settings.user.create')}}" class="btn btn-primary">Input Data</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection