<!doctype html>
<html class="fixed sidebar-light">
	<head>
		<title>{{ config('app.name', 'Laravel') }}</title>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Open Swelab</title>

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		@include('partials._styles')
	</head>
	
	<body>

		<section class="body">
			@include('admin._navbar')
	
			<div class="inner-wrapper">
			    @include('admin.sidebar')
			    
			    <section role="main" class="content-body">
			        @yield('content')
			    </section>
		    </div>
		</section>

		@include('partials._scripts')
	</body>
	
</html>
