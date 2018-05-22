@extends('layouts.public')

@section('content')
<section class="content-header">
    <h1>
        Profil
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Profil</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-default">
                <div class="box-body box-profile">
                    @if($user->image)
                    <img class="profile-user-img img-responsive img-circle" src="{{asset('storage/'. $user->image)}}"
                         alt="User profile picture">
                    @else
                    <img class="profile-user-img img-responsive img-circle"
                         src="{{asset('adminlte/dist/img/avatar5.png')}}" alt="User profile picture">
                    @endif
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-muted text-center">{{ $user->roles }}</p>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Notifikasi</a></li>
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        @foreach($notification->get() as $rd)
                        @php
                        $image = App\Models\User::where('id', $rd->sender)->first();
                        @endphp
                        <div class="post {{$rd->read ? '' : 'bg-gray disabled color-palette'}}">
                            <div class="user-block">
                                @if($image['image'])
                                <img class="img-circle img-bordered-sm" src="{{asset('storage/'.$image['image'])}}"
                                     alt="user image">
                                @else
                                <img class="img-circle img-bordered-sm" src="{{asset('adminlte/dist/img/avatar5.png')}}"
                                     alt="User Image">
                                @endif
                                <span class="username">
                                    <a href="#">{{$rd->sender_name}}</a>
                                </span>
                                <span class="description">{{$rd->created_at->format('d F Y')}} ({{$rd->created_at->diffForHumans()}})</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                <a href="{{route('api.postStatus', $rd->id)}}">
                                    {{$rd->text}}
                                </a>
                            </p>
                        </div>
                        @endforeach
                    </div>

                    <div class="tab-pane" id="settings">
                        {!! Former::open_for_files(route('profile.update', $user->id))->method('put') !!}
                        {!! Former::populate($user) !!}
                        {!! Former::text('name')->required() !!}
                        {!! Former::text('email')->required() !!}
                        {!! Former::password('password')->required() !!}
                        {!! Former::file('file')->label('Image')->accept('image')
                        ->help('File harus berekstensi .jpg, .jpeg, .png, .bmp dan tidak lebih dari 5 Mb.')
                        ->max(5, 'MB') !!}
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection