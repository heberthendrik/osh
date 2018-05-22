@extends('layouts.app')

@section('content')
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