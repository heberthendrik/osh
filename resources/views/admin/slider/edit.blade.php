@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Slider</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li><a href="{{route('settings.slider.index')}}">Slider</a></li>
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
                {!! Former::populate($slider) !!}
                {!! Former::open(route('settings.slider.update', $slider->id))->method('put') !!}
                <div class="box-body">
                    {!! Former::text('alt') !!}
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