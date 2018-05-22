@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>User</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.user.index')}}">User</a></li>
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
                {!! Former::populate($user) !!}
                {!! Former::open(route('settings.user.update', $user->id))->method('put') !!}
                <div class="box-body">
                    {!! Former::text('name')->required() !!}
                    {!! Former::text('email')->required() !!}
                    {!! Former::password('password')->required() !!}
                    {!! Former::select('roles')->options([
                    'admin' => 'Admin',
                    'doctor' => 'Doctor',
                    'officer' => 'Officer'
                    ])->required() !!}
                    {!! Former::select('id_rs')
                    ->label('Rumah Sakit')
                    ->class('form-control select2')
                    ->options($filters['id_rs'])
                    ->required() !!}
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{route('settings.user.index')}}" class="btn btn-default">Batal</a>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection