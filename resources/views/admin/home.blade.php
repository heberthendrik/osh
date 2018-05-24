@extends('layouts.app')

@section('content')



<header class="page-header">
	<h2>Dashboard</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="dashboard_admin.html">
					<i class="fa fa-home"></i>
				</a>
			</li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>

	
</header>

<div class="row">
	<div class="col-md-12 col-lg-12 col-xl-12">
		<div class="row">
			<div class="col-md-12 col-lg-3 col-xl-3">
				<section class="panel panel-featured-left panel-featured-primary">
					<div class="panel-body">
						<div class="widget-summary">
							<div class="widget-summary-col">
								<div class="summary">
									<h4 class="title">Daily Lab Generated</h4>
									<div class="info">
										<strong class="amount">1281</strong>
									</div>
								</div>
								<div class="summary-footer">
									<a class="text-muted text-uppercase">(view all)</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-12 col-lg-3 col-xl-3">
				<section class="panel panel-featured-left panel-featured-secondary">
					<div class="panel-body">
						<div class="widget-summary">
							<div class="widget-summary-col">
								<div class="summary">
									<h4 class="title">Daily Pending Approval</h4>
									<div class="info">
										<strong class="amount">13</strong>
									</div>
								</div>
								<div class="summary-footer">
									<a class="text-muted text-uppercase">(view all)</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-12 col-lg-3 col-xl-3">
				<section class="panel panel-featured-left panel-featured-tertiary">
					<div class="panel-body">
						<div class="widget-summary">
							<div class="widget-summary-col">
								<div class="summary">
									<h4 class="title">Today's Report</h4>
									<div class="info">
										<strong class="amount">38</strong>
									</div>
								</div>
								<div class="summary-footer">
									<a class="text-muted text-uppercase">(view all)</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-12 col-lg-3 col-xl-3">
				<section class="panel panel-featured-left panel-featured-quaternary">
					<div class="panel-body">
						<div class="widget-summary">
							<div class="widget-summary-col">
								<div class="summary">
									<h4 class="title">Today's Patient</h4>
									<div class="info">
										<strong class="amount">3765</strong>
									</div>
								</div>
								<div class="summary-footer">
									<a class="text-muted text-uppercase">(view all)</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>

<!-- start: page -->
<div class="row">
	<div class="col-md-6 col-lg-12 col-xl-6">
		<section class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<div class="chart-data-selector" id="salesSelectorWrapper">
							<h2>
								Weekly Lab Statistic:
								<strong>
									<select class="form-control" id="salesSelector">
										<option value="LabTotal" selected>Generated</option>
										<option value="LabApproved" >Approved</option>
										<option value="LabPending" >Pending</option>
									</select>
								</strong>
							</h2>

							<div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
								
								<div class="chart chart-sm" data-sales-rel="LabTotal" id="flotDashSales1" class="chart-active"></div>
								<script>

									var flotDashSales1Data = [{
									    data: [
									        ["Mon", 140],
									        ["Tue", 240],
									        ["Wed", 190],
									        ["Thu", 140],
									        ["Fri", 180],
									        ["Sat", 320],
									        ["Sun", 270]
									    ],
									    color: "#0088cc"
									}];

									

								</script>

								
								<div class="chart chart-sm" data-sales-rel="LabApproved" id="flotDashSales2" class="chart-hidden"></div>
								<script>

									var flotDashSales2Data = [{
									    data: [
									        ["Mon", 240],
									        ["Tue", 240],
									        ["Wed", 290],
									        ["Thu", 540],
									        ["Fri", 480],
									        ["Sat", 220],
									        ["Sun", 170]
									    ],
									    color: "#2baab1"
									}];

									

								</script>

								
								<div class="chart chart-sm" data-sales-rel="LabPending" id="flotDashSales3" class="chart-hidden"></div>
								<script>

									var flotDashSales3Data = [{
									    data: [
									        ["Mon", 840],
									        ["Tue", 740],
									        ["Wed", 690],
									        ["Thu", 940],
									        ["Fri", 1180],
									        ["Sat", 820],
									        ["Sun", 570]
									    ],
									    color: "#734ba9"
									}];

									

								</script>
							</div>

						</div>
					</div>
					<div class="col-lg-4 text-center">
						<h2 class="panel-title mt-md">Report Completion</h2>
						<div class="liquid-meter-wrapper liquid-meter-sm mt-lg">
							<div class="liquid-meter">
								<meter min="0" max="100" value="35" id="meterSales"></meter>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</section>
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-md-12">
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
						</div>

						<h2 class="panel-title">Gender Statistic</h2>
						<p class="panel-subtitle">Customer gender statistic</p>
					</header>
					<div class="panel-body">
						<div class="row text-center">
							<div class="col-md-6">
								<div class="circular-bar">
									<div class="circular-bar-chart" data-percent="85" data-plugin-options='{ "barColor": "#0088CC", "delay": 300 }'>
										<strong>Male</strong>
										<label><span class="percent">85</span>%</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="circular-bar">
									<div class="circular-bar-chart" data-percent="15" data-plugin-options='{ "barColor": "#2BAAB1", "delay": 600 }'>
										<strong>Female</strong>
										<label><span class="percent">15</span>%</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	
</div>

<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
					<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
				</div>

				<h2 class="panel-title">Daily Lab Statistic</h2>
				<p class="panel-subtitle">Total lab data generated from 00.00 - 23.00 today.</p>
			</header>
			<div class="panel-body">

				<!-- Flot: Basic -->
				<div class="chart chart-md" id="flotDashBasic"></div>
				<script>

					var flotDashBasicData = [{
						data: [
							[0, 170],
							[1, 169],
							[2, 173],
							[3, 188],
							[4, 147],
							[5, 113],
							[6, 128],
							[7, 169],
							[8, 173],
							[9, 128],
							[10, 128],
							[11, 170],
							[12, 169],
							[13, 173],
							[14, 188],
							[15, 147],
							[16, 113],
							[17, 128],
							[18, 169],
							[19, 173],
							[20, 128],
							[21, 169],
							[22, 188],
							[23, 147]
							
						],
						label: "Generated",
						color: "#0088cc"
					}];

					

				</script>

			</div>
		</section>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<section class="panel">
			<header class="panel-heading panel-heading-transparent">
				<div class="panel-actions">
					<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
					<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
				</div>

				<h2 class="panel-title">Lab Report</h2>
			</header>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped mb-none">
						<thead>
							<tr>
								<th>#</th>
								<th>Report ID</th>
								<th>Status</th>
								<th>Progress</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>#123</td>
								<td><span class="label label-success">Complete</span></td>
								<td>
									<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
										<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
											100%
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>#234</td>
								<td><span class="label label-success">Complete</span></td>
								<td>
									<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
										<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
											100%
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>#345</td>
								<td><span class="label label-warning">On Progress</span></td>
								<td>
									<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
										<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
											60%
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>#456</td>
								<td><span class="label label-success">Complete</span></td>
								<td>
									<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
										<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
											90%
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>#567</td>
								<td><span class="label label-warning">On Progress</span></td>
								<td>
									<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
										<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
											45%
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td>#678</td>
								<td><span class="label label-danger">Rejected</span></td>
								<td>
									<div class="progress progress-sm progress-half-rounded m-none mt-xs light">
										<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
											40%
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td>#789</td>
								<td><span class="label label-success">Complete</span></td>
								<td>
									<div class="progress progress-sm progress-half-rounded mt-xs light">
										<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">
											95%
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>

<div class="row">
	<div class="col-md-3">
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
					<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
				</div>

				<h2 class="panel-title">Age Statistic</h2>
				<p class="panel-subtitle">Customer age comparison statistic</p>
			</header>
			<div class="panel-body">

				<div class="chart chart-md" id="flotPie"></div>
				<script type="text/javascript">

					var flotPieData = [{
						label: "<20",
						data: [
							[1, 60]
						],
						color: '#0088cc'
					}, {
						label: "20-30",
						data: [
							[1, 10]
						],
						color: '#2baab1'
					}, {
						label: "30-40",
						data: [
							[1, 15]
						],
						color: '#734ba9'
					}, {
						label: ">40",
						data: [
							[1, 15]
						],
						color: '#E36159'
					}];

				</script>

			</div>
		</section>
	</div>
	<div class="col-md-9">
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
					<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
				</div>

				<h2 class="panel-title">Doctor's KPI</h2>
				<p class="panel-subtitle">Key performance indicator for doctor approval this year</p>
			</header>
			<div class="panel-body">

				<div class="chart chart-md" id="flotBars"></div>
				<script type="text/javascript">

					var flotBarsData = [
						["Jan", 28],
						["Feb", 42],
						["Mar", 25],
						["Apr", 23],
						["May", 37],
						["Jun", 33],
						["Jul", 18],
						["Aug", 14],
						["Sep", 18],
						["Oct", 15],
						["Nov", 4],
						["Dec", 7]
					];

				</script>

			</div>
		</section>
	</div>
	
</div>

<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading panel-heading-transparent">
				<div class="panel-actions">
					<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
					<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
				</div>

				<h2 class="panel-title">Server Log</h2>
			</header>
			<div class="panel-body">
				<div id="access-log" class="tab-pane active">
					<table class="table table-striped table-no-more table-bordered  mb-none">
						<thead>
							<tr>
								<th style="width: 10%"><span class="text-weight-normal text-sm">Type</span></th>
								<th style="width: 15%"><span class="text-weight-normal text-sm">Date</span></th>
								<th><span class="text-weight-normal text-sm">Message</span></th>
							</tr>
						</thead>
						<tbody class="log-viewer">
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-bug fa-fw text-muted text-md va-middle"></i>
									<span class="va-middle">Debug</span>
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2016 18:25:59
								</td>
								<td data-title="Message" class="pt-md pb-md">
									my.host - oh snap! another exception
								</td>
							</tr>
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-info fa-fw text-info text-md va-middle"></i>
									<span class="va-middle">Info</span>
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2016 21:50:17
								</td>
								<td data-title="Message" class="pt-md pb-md">
									"GET / HTTP/1.1" 200 1225
								</td>
							</tr>
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-warning fa-fw text-warning text-md va-middle"></i>
									<span class="va-middle">Warning</span>
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2016 17:44:21
								</td>
								<td data-title="Message" class="pt-md pb-md">
									DocumentRoot [/var/www/hebert_admin/] does not exist
								</td>
							</tr>
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-times-circle fa-fw text-danger text-md va-middle"></i>
									<span class="va-middle">Error</span>
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2016 21:55:18
								</td>
								<td data-title="Message" class="pt-md pb-md">
									File does not exist: /var/www/hebert_admin/favicon.ico
								</td>
							</tr>
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-ban fa-fw text-danger text-md va-middle"></i>
									<span class="va-middle">Fatal</span>
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2016 22:13:39
								</td>
								<td data-title="Message" class="pt-md pb-md">
									not a tree object
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>

				
				
<!--
<section class="content-header">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Dashboard</h3>
                </div>
                <div class="box-body">
                    <div class="actions">
                        {!! Former::open_inline(route('settings.dashboard.index'))->method('get') !!}
                        {!! Former::select('tahun')
                        ->label('')
                        ->options(['' => 'Pilih Tahun'])
                        ->options($filters['tahun'])
                        !!}
                        {!! Former::select('tipe')
                        ->label('')
                        ->options(['day' => 'Harian','month'=> 'Bulanan', 'year'=>'Tahunan'])
                        !!}
                        <button class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                        {!! Former::close() !!}
                    </div>

                    <canvas id="plt-chart" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
-->
@endsection

@section('scripts')
<script src="{{asset('js/Chart.js')}}"></script>
<script>
    $(function(){
        var jumlah = <?php echo $jumlah; ?>;

        var barChartData = {
            labels: <?php echo $tanggal; ?>,
            datasets: [{
                label: 'Jumlah',
                pointStyle: 'line',
                backgroundColor : "rgba(0,255,0,0.5)",
                data: jumlah
            }]
        };

        var ctx = document.getElementById("plt-chart").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'line',
            data: barChartData,
            options: {
                title: {
                    display: true,
                    text: 'Jumlah Pemeriksaan Lab'
                },
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        });
    });
</script>
@endsection