@extends('layouts.public')

@section('content')

<header class="page-header">
    <h2>Dashboard</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="{{route('home')}}">
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
                                    <h4 class="title">Today Lab Number</h4>

                                    <div class="info">
                                        <strong class="amount">{{ $data['today'] }}</strong>
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
                                    <h4 class="title">Today Completed Report</h4>

                                    <div class="info">
                                        <strong class="amount">{{ $data['todayComplete'] }}</strong>
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
                                    <h4 class="title">Today Pending Approval</h4>

                                    <div class="info">
                                        <strong class="amount">{{$data['todayPending']}}</strong>
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
                                    <h4 class="title">Number of Customer Today</h4>

                                    <div class="info">
                                        <strong class="amount">{{$data['todayCustomer']}}</strong>
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
                <div class="chart chart-md" id="flotDashBasic"></div>
                <script>
                    var flotDashBasicData = [
                        {
                            data:[<?php echo $data['MonthlyResult'];?>],
                            label:"Generated",
                            color:"#0088cc"
                        }
                    ];
                </script>
            </div>
        </section>
    </div>
</div>

<!-- start: page -->
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-6">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>
                <h2 class="panel-title">Weekly Lab Statistic</h2>
                <p class="panel-subtitle">Total lab occurance and lab report approval made within a week.</p>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="chart-data-selector" id="salesSelectorWrapper">
                            <h2>
                                <strong>
                                    <select class="form-control" id="salesSelector">
                                        <option value="LabTotal" selected>Generated</option>
                                        <option value="LabApproved">Approved</option>
                                        <option value="LabPending">Pending</option>
                                    </select>
                                </strong>
                            </h2>

                            <div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
                                <div class="chart chart-sm" data-sales-rel="LabTotal" id="flotDashSales1"
                                     class="chart-active"></div>
                                <script>
                                    var flotDashSales1Data = [
                                        {
                                            data:[<?php echo $data['WeeklyResult'];?>],
                                            color:"#0088cc"
                                        }
                                    ];
                                </script>

                                <div class="chart chart-sm" data-sales-rel="LabApproved" id="flotDashSales2"
                                     class="chart-hidden"></div>
                                <script>
                                    var flotDashSales2Data = [
                                        {
                                            data:[<?php echo $data['WeeklyApproved'];?>],
                                            color:"#2baab1"
                                        }
                                    ];
                                </script>

                                <div class="chart chart-sm" data-sales-rel="LabPending" id="flotDashSales3"
                                     class="chart-hidden"></div>
                                <script>
                                    var flotDashSales3Data = [
                                        {
                                            data:[<?php echo $data['WeeklyPending'];?>],
                                            color:"#734ba9"
                                        }
                                    ];
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <h2 class="panel-title mt-md">Report Completion</h2>

                        <div class="liquid-meter-wrapper liquid-meter-sm mt-lg">
                            <div class="liquid-meter">
                                <meter min="0" max="100" value="{{$data['resultComplete']}}" id="meterSales"></meter>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-6">
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
                            <div class="circular-bar-chart" data-percent="{{$data['male_customer']}}"
                                 data-plugin-options='{ "barColor": "#0088CC", "delay": 300 }'>
                                <strong>Male</strong>
                                <label><span class="percent">{{$data['male_customer']}}</span>%</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="circular-bar">
                            <div class="circular-bar-chart" data-percent="{{$data['female_customer']}}"
                                 data-plugin-options='{ "barColor": "#2BAAB1", "delay": 600 }'>
                                <strong>Female</strong>
                                <label><span class="percent">{{$data['female_customer']}}</span>%</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">Latest Lab Data</h2>
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
                        @php $i=1;@endphp
                        @foreach($data['latestData'] as $rsData)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$rsData->id}}</td>
                            @php
                            $value=33;
                            $class = "label label-danger";
                            $label = "Need Officer Approval";

                            if($rsData->kd_pemeriksa){
                            $value += 33;
                            $class = "label label-warning";
                            $label = "Need Doctor Approval";
                            }

                            if($rsData->kd_acc){
                                $value += 34;
                                $class = "label label-success";
                                $label = "Already Reviewed";
                            }
                            @endphp
                            <td>
                                <span class="{{$class}}">{{$label}}</span>
                            </td>
                            <td>
                                <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                    <div class="progress-bar progress-bar-primary" role="progressbar"
                                         aria-valuenow="{{$value}}"
                                         aria-valuemin="0" aria-valuemax="100" style="width: {{$value}}%;">
                                        {{$value}}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
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
                    var flotPieData = [
                        {
                            label:"<20",
                            data:[
                                [1, <?php echo $data['under20']?>]
                            ],
                            color:'#0088cc'
                        },
                        {
                            label:"20-30",
                            data:[
                                [1, <?php echo $data['age20']?>]
                            ],
                            color:'#2baab1'
                        },
                        {
                            label:"30-40",
                            data:[
                                [1, <?php echo $data['age30']?>]
                            ],
                            color:'#734ba9'
                        },
                        {
                            label:">40",
                            data:[
                                [1, <?php echo $data['above40']?>]
                            ],
                            color:'#E36159'
                        }
                    ];

                </script>

            </div>
        </section>
    </div>
    <div class="col-md-8">
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
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>
                <h2 class="panel-title">System Log</h2>
            </header>
            <div class="panel-body">
                <div id="access-log" class="tab-pane active" style="max-height:500px;overflow-y:scroll;">
                    <table class="table table-striped table-no-more table-bordered  mb-none">
                        <thead>
                        <tr>
                            <th style="width: 10%"><span class="text-weight-normal text-sm">Type</span></th>
                            <th style="width: 15%"><span class="text-weight-normal text-sm">Date</span></th>
                            <th><span class="text-weight-normal text-sm">Message</span></th>
                        </tr>
                        </thead>
                        <tbody class="log-viewer">
                        <?php
                        $handle = fopen(storage_path('logs/laravel.log'), "r");
                        if ($handle) {
                            while (($buffer = fgets($handle, 4096)) !== false ) {
                                if( substr($buffer,1,4) == date('Y') ){
                                    echo
                                       '
							        <tr>
			                            <td data-title="Type" class="pt-md pb-md">
			                                <i class="fa fa-times-circle fa-fw text-danger text-md va-middle"></i>
			                                <span class="va-middle">Error</span>
			                            </td>
			                            <td data-title="Date" class="pt-md pb-md">
			                                '.substr($buffer,1,19).'
			                            </td>
			                            <td data-title="Message" class="pt-md pb-md">
			                                '.substr($buffer,22).'
			                            </td>
			                        </tr>
							        ';
                                }
                            }
                            if (!feof($handle)) {
                                echo "Error: unexpected fgets() fail\n";
                            }
                            fclose($handle);
                        }
                        ?>
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






<!--
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Pemeriksaan Bulanan</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart">
                                <canvas id="customerChart" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="box box-solid">
                @php
                $first_slider = true;
                $i=0;
                @endphp
                <div class="box-body">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="{{ ($sliders->count()) ? '' : 'background: #f00'  }}">
                        <ol class="carousel-indicators">
                            @if($sliders->count())
                            @foreach($sliders as $slider)
                            <li data-target="#main-carousel" data-slide-to="{{$i}}" class="{{$first_slider ? 'active' : ''}}"></li>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                            @endif
                        </ol>
                        <div class="carousel-inner">
                            @if($sliders->count())
                            @foreach($sliders as $slider)
                            <div class="item {{$first_slider ? 'active' : ''}}">
                                <img src="{{asset('storage/'.$slider->image)}}" alt="{{$slider->alt}}">

                                <div class="carousel-caption">
                                    {{$slider->alt}}
                                </div>
                            </div>
                            @php
                            $first_slider = false;
                            @endphp
                            @endforeach
                            @else
                            <div class="item active"></div>
                            @endif
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="fa fa-angle-right"></span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        @php
        $notif = App\Models\Notification::where('receiver', Auth::user()->id)->where('read','0');
        @endphp
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bell-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Notifikasi</span>
                    <span class="info-box-number">{{ $notif->count() }}</span>
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
    <!--    $(function () {-->
    <!--        var jumlah = --><?php //echo $jumlah; ?><!--;-->
    <!---->
    <!--        var barChartData = {-->
    <!--            labels: --><?php //echo $tanggal; ?><!--,-->
    <!--            datasets:[-->
    <!--                {-->
    <!--                    label:'Jumlah',-->
    <!--                    pointStyle:'line',-->
    <!--                    backgroundColor:"rgba(0,255,0,0.5)",-->
    <!--                    data:jumlah-->
    <!--                }-->
    <!--            ]-->
    <!--        };-->
    <!---->
    <!--        var ctx = document.getElementById("customerChart").getContext("2d");-->
    <!--        window.myBar = new Chart(ctx, {-->
    <!--            type:'line',-->
    <!--            data:barChartData,-->
    <!--            options:{-->
    <!--                title:{-->
    <!--                    display:true,-->
    <!--                    text:'Jumlah Pemeriksaan Lab'-->
    <!--                },-->
    <!--                legend:{-->
    <!--                    display:true,-->
    <!--                    position:'bottom'-->
    <!--                }-->
    <!--            }-->
    <!--        });-->
    <!--    });-->
</script>


<script type="text/javascript">
    $(function () {
        var $item = $('.carousel .item');
        var $wHeight = '600px';
        $item.height($wHeight);


        $('.carousel').carousel({
            interval:6000,
            pause:"false"
        });
    });
</script>
@endsection