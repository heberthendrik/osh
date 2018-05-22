<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @include('partials._styles')
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
    @include('admin._navbar')

    @include('admin.sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2018 PT. Swelab Indonesia.</strong> All rights
            reserved.
        </div>
    </footer>
</div>

@include('partials._scripts')
</body>
</html>
