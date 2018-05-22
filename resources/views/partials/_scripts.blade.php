		<!-- Vendor -->
		<script src="{{ asset('hebert_admin/assets/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jquery-placeholder/jquery-placeholder.js') }}"></script>
		
		<!-- Specific Page Vendor -->
		<script src="{{ asset('hebert_admin/assets/vendor/jquery-ui/jquery-ui.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jquery-appear/jquery-appear.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/flot/jquery.flot.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/flot.tooltip/flot.tooltip.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/flot/jquery.flot.categories.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/flot/jquery.flot.resize.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jquery-sparkline/jquery-sparkline.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/raphael/raphael.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/morris.js/morris.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/gauge/gauge.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/snap.svg/snap.svg.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/liquid-meter/liquid.meter.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqvmap/jquery.vmap.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/select2/js/select2.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('hebert_admin/assets/javascripts/theme.js') }}"></script>
		
		<!-- Theme Custom -->
		<script src="{{ asset('hebert_admin/assets/javascripts/theme.custom.js') }}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ asset('hebert_admin/assets/javascripts/theme.init.js') }}"></script>

		<!-- Examples -->
		<script src="{{ asset('hebert_admin/assets/javascripts/dashboard/examples.dashboard.js') }}"></script>
		<script src="{{ asset('hebert_admin/assets/javascripts/tables/examples.datatables.editable.js') }}"></script>

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