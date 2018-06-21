<!doctype html>
<html class="fixed">
	<head>
		<title>{{ config('app.name', 'Laravel') }}</title>
		<!-- Basic -->
		<meta charset="UTF-8">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('hebert_admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />

		<link rel="stylesheet" href="{{ asset('hebert_admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
		<link rel="stylesheet" href="{{ asset('hebert_admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('hebert_admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('hebert_admin/assets/stylesheets/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('hebert_admin/assets/stylesheets/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('hebert_admin/assets/stylesheets/theme-custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('hebert_admin/assets/vendor/modernizr/modernizr.js') }}"></script>

	</head>
	<body>
		<!-- start: page -->
		
		<section class="body-sign">

			<div class="center-sign">
				
				<div class="row" style="margin-bottom:-30px;">
					<div class="col-md-12 text-center">
						<img src="{{ asset('hebert_admin/images/logo_swelab_square.png') }}" style="max-height:300px;width:auto;" />
					</div>
				</div>
				
				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('login') }}">
							{{ csrf_field() }}
							<div class="form-group mb-lg  has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
								<label>Email</label>
								<div class="input-group input-group-icon">
									<input  type="email" name="email" type="text" class="form-control input-lg" value="{{ old('email') }}" required autofocus />
									@if ($errors->has('email'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('email') }}</strong>
					                </span>
					                @endif
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg  has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									<a href="pages-recover-password.html" class="pull-right">Lost Password?</a>
								</div>
								<div class="input-group input-group-icon">
									<input  type="password" name="password" class="form-control input-lg" required />
									@if ($errors->has('password'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('password') }}</strong>
					                                    </span>
					                @endif
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
								</div>
							</div>

							

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="{{ asset('hebert_admin/assets/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jquery-placeholder/jquery-placeholder.js') }}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('hebert_admin/assets/javascripts/theme.js') }}"></script>
		
		<!-- Theme Custom -->
		<script src="{{ asset('hebert_admin/assets/javascripts/theme.custom.js') }}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ asset('hebert_admin/assets/javascripts/theme.init.js') }}"></script>

	</body>
</html>