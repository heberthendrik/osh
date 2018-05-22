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
			    
			    	<style>
						.required{
							display:inherit;
						}
						label{
							color:#777;
							font-size:13px;
						}
						label sup{
							color:red;
							font-size:13px;
							padding-left:5px;
						}
						select, .select2-selection__rendered, input{
							font-size:13px!important;
							font-weight:normal!important;
						}
						
						.select2-selection{
							height:35px!important;
						}
					</style>
			    
			        @yield('content')
			    </section>
		    </div>
		</section>

		@include('partials._scripts')
	</body>
	
</html>
