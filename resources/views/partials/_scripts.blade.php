<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>

<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script src="{{ asset('js/index.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@yield('scripts')

@if (notify()->ready())
<script>
    swal({
        text:"{{ notify()->message() }}",
        type:"{{ notify()->type() }}",
        title:"{{ notify()->option('title') }}",
        timer:5000
    });
</script>
@endif


<script type="text/javascript">
    $('.select2').select2();
</script>

<script>
        $('#example1').DataTable({
            'ordering':false
        })

        $('#example2').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'info'        : false
        })
</script>