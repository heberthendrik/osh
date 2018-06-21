<!doctype html>
<html class="fixed sidebar-light">
	<head>
		<title>{{ config('app.name', 'Laravel') }}</title>
		<!-- Basic -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		@include('partials._styles')
	</head>
	
	<body>
	
		<section class="body">
			@include('layouts._navbar')
	
			<div class="inner-wrapper">
			    
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
						
						.content-body{
							margin-left:0px!important;
						}
						
						html.fixed .page-header{
							left:0px;
						}
					</style>
			    
			        @yield('content')
			    </section>
		    </div>
		</section>
	
		@include('partials._scripts')
	</body>
</html>
