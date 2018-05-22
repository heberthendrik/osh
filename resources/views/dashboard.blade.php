@extends('layouts.public')

@section('content')
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
                <!-- /.box-header -->
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
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
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
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
</section>

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

        var ctx = document.getElementById("customerChart").getContext("2d");
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