@extends('layouts.public')

@section('content')
<header class="page-header">
	<h2>Profil</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
			<li><span>Profil</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<div class="row">
	<div class="col-md-4 col-lg-3">

		<section class="panel">
			<div class="panel-body">
			
			<div class="thumb-info mb-md">
					@if($user->image)
						<img src="{{asset('storage/'. $user->image)}}" class="rounded img-responsive" alt="John Doe" style="width:100%;height:auto;">
					@else
						<img src="{{asset('adminlte/dist/img/avatar5.png')}}" class="rounded img-responsive" alt="John Doe" style="width:100%;height:auto;">
					@endif
					<div class="thumb-info-title">
						<span class="thumb-info-inner">{{ $user->name }}</span>
						<span class="thumb-info-type">{{ $user->roles }}</span>
					</div>
				</div>

			</div>
		</section>

	</div>
	<div class="col-md-8 col-lg-6">

		<div class="tabs">
			<ul class="nav nav-tabs tabs-primary">
				<li class="active">
					<a href="#overview" data-toggle="tab">Notifikasi</a>
				</li>
				<li>
					<a href="#edit" data-toggle="tab">Edit</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="overview" class="tab-pane active">
					<div class="timeline timeline-simple mt-xlg mb-md">
						<div class="tm-body">
							<div class="tm-title">
								<h3 class="h5 text-uppercase">NOW</h3>
							</div>					
							<ol class="tm-items">
								
								<li>
									<div class="tm-box">
										<p class="text-muted mb-none">2 minutes ago</p>
										<p>
											Officer ID #1234 generate report ID #123456 on 2018-04-23. <br/><span class="text-primary"><a href="#">Review now</a></span>
										</p>
									</div>
								</li>
								<li>
									<div class="tm-box">
										<p class="text-muted mb-none">5 months ago</p>
										<p>
											Doctor ID #14232 reviewed report ID #111222. Result: <strong>APPROVED</strong>!
										</p>
									</div>
								</li>
								<li>
									<div class="tm-box">
										<p class="text-muted mb-none">Yesterday</p>
										<p>
											Doctor ID #23132 reviewed report ID #1134. Result: <strong>REJECTED</strong>!
										</p>
									</div>
								</li>
								<li>
									<div class="tm-box">
										<p class="text-muted mb-none">20 December 2017 11.00am</p>
										<p>
											Officer ID #1234 generate report ID #123456 on 2018-04-23. <br/><span class="text-primary"><a href="#">Review now</a></span>
										</p>
									</div>
								</li>
							</ol>
						</div>
					</div>
				</div>
				<div id="edit" class="tab-pane">

					
						<h4 class="mb-xlg">Personal Information</h4>
						
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
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        {!! Former::close() !!}
                        
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-lg-3">

		<h4 class="mb-md">Work Stats</h4>
		<ul class="simple-card-list mb-xlg">
			<li class="primary">
				<h3>488</h3>
				<p>Report Generated</p>
			</li>
			<li class="primary">
				<h3>123</h3>
				<p>Pending Report</p>
			</li>
			<li class="primary">
				<h3>234</h3>
				<p>Report Completed</p>
			</li>
		</ul>

	</div>

</div>
@endsection