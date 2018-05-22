@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Slider</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.slider.index')}}">Slider</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Input Data</h3>
                </div>
                {!! Former::open_for_files(route('settings.slider.store'))->method('post') !!}
                <div class="box-body">
                    {!! Former::text('alt') !!}
                    {!! Former::file('slider')
                    ->label('Image')->accept('image')
                    ->help('File harus berekstensi .jpg, .jpeg, .png, .bmp dan tidak lebih dari 5 Mb.')
                    ->max(5, 'MB')->required() !!}
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{route('settings.slider.index')}}" class="btn btn-default">Batal</a>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection