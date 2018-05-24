@extends('layouts.public')

@section('content')
<header class="page-header">
	<h2>Laporan - <span style="color:#dc1b30;">{{$result->no_lab}} - {{$result->nama}}</span></h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
			<li><a href="{{route('report.summary.index')}}">Hasil Lab</a></li>
			<li><span>Detil</span></li>
		</ol>

		<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>





<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<div class="row">					
					<h2 class="panel-title" style="padding-left:15px;">{{$result->no_lab}} - {{$result->nama}}</h2>
					<div class="pull-right" style="padding-right:20px;float:right;position:absolute;right:0;top:0;margin-top:15px;">
						{!! DNS1D::getBarcodeHTML($result->no_lab, "C128", '1','30')!!}
					</div>
				</div>
			</header>
			<div class="panel-body">
				<div class="box-body">
                    
                    @if($result->count())
					<div class="row">
					    <div class="col-md-9">
					        <table class="table table-striped table-responsive">
					            <tr>
					                <th>Tanggal</th>
					                <td>{{ date('d F Y', strtotime($result->created_at)) }}</td>
					                <th>No. Lab</th>
					                <td>{{$result->no_lab}}</td>
					                <th>Status</th>
					                <td>{{$result->nm_status}}</td>
					            </tr>
					            <tr>
					                <th>No. Rekam Medis</th>
					                <td colspan="3">{{$result->no_rm}}</td>
					                <th>Dokter Pengirim</th>
					                <td>{{$result->nm_dokter}}</td>
					            </tr>
					            <tr>
					                <th>Nama</th>
					                <td colspan="3">{{$result->nama}}</td>
					                <th>Alamat Dokter</th>
					                <td>{{$result->alamat_dokter}}</td>
					            </tr>
					            <tr>
					                <th>Tanggal Lahir</th>
					                <td colspan="3">@if(isset($result->tgl_lahir))
					                    {{ date('d F Y', strtotime($result->tgl_lahir)) }}
					                    @endif
					                </td>
					                <th>Ket Klinik</th>
					                <td>{{$result->ket_klinik}}</td>
					            </tr>
					            <tr>
					                <th>Umur</th>
					                <td colspan="3">{{$result->umur}} {{$result->umur_sat}}
					                </td>
					                <th>Catatan 1</th>
					                <td>{{$result->catatan_1}}</td>
					            </tr>
					            <tr>
					                <th>Alamat</th>
					                <td colspan="3">{{$result->alamat}}</td>
					                <th>Catatan 2</th>
					                <td>{{$result->catatan_2}}</td>
					            </tr>
					            <tr>
					                <th>Ruang</th>
					                <td colspan="3">{{$result->nm_ruang}}</td>
					                <th>Dokter ACC</th>
					                <td>{{$result->nm_dokter_acc}}</td>
					            </tr>
					            <tr>
					                <th>Kelas</th>
					                <td colspan="3">{{$result->nm_kelas}}</td>
					                <th>Pemeriksa</th>
					                <td>{{$result->nm_pemeriksa}}</td>
					            </tr>
					        </table>
					
					        <table class="table table-bordered table-responsive">
					            <thead>
					            <tr>
					                <th>Pemeriksaan</th>
					                <th>Hasil</th>
					                <th>N Rujukan</th>
					                <th>Satuan</th>
					                <th>Pemeriksaan</th>
					                <th>Hasil</th>
					                <th>N Rujukan</th>
					                <th>Satuan</th>
					            </tr>
					            </thead>
					            @if($result->details->count())
					            <tbody>
					            @php
					            $i = 0;
					            @endphp
					
					            @foreach ($result->details as $rd)
					            @if($i == 0 || $i % 2 == 0)
					            @if ($i % 2 == 0)
					            </tr>
					            @endif
					            <tr>
					                @endif
					                <td>
					                    @if(isset($rd->id_lab))
					                    {{$rd->Kdlab->nama}}
					                    @endif
					                </td>
					                @if($rd->flag == "5")
					                <td style="color:purple;"><b>{{$rd->hasil}}</b> *</td>
					                @elseif($rd->flag == "4")
					                <td style="color:red;"><b>{{$rd->hasil}}</b> *</td>
					                @else
					                <td style="color:green;"><b>{{$rd->hasil}}</b></td>
					                @endif
					                <td>{{$rd->n_rujukan}}</td>
					                <td>{{$rd->satuan}}</td>
					                @php
					                $i++
					                @endphp
					                @endforeach
					            </tr>
					            @else
					            <tr>
					                <td colspan="10">
					                    <i class="fa fa-fw fa-info-circle text-primary"></i> Data Hasil Lab Tidak Ditemukan
					                </td>
					            </tr>
					            </tbody>
					            @endif
					        </table>
					    </div>
					    <div class="col-md-3">
					        @if($result->histogram)
					        <canvas id="plt-chart" height="200"></canvas>
					        <canvas id="rbc-chart" height="200"></canvas>
					        <canvas id="wbc-chart" height="200"></canvas>
					        @php
					        $img = $result->histogram->image;
					        $decode = base64_decode($img);
					        $ar = (array)json_decode($decode);
					        $plt_value = json_encode($ar['PLT']->values->PLT);
					        $rbc_value = json_encode($ar['RBC']->values->RBC);
					        $wbc_value = json_encode($ar['WBC']->values->WBC);
					        @endphp
					        @else
					        @php
					        $plt_value = 0;
					        $rbc_value = 0;
					        $wbc_value = 0;
					        @endphp
					        <i class="fa fa-fw fa-info-circle text-primary"></i> Data Histogram Tidak Ditemukan
					        @endif
					    </div>
					</div>
					@else
					<i class="fa fa-fw fa-info-circle text-primary"></i> Data Tidak Ditemukan
					@endif
					
					<div class="row no-print">
					    <div class="col-xs-12">
					        @if($result->kd_acc)
					        <a class="btn btn-default" href="{{route('result.getPrint', $result->id)}}"><i class="fa fa-print"></i> Cetak</a>
					        @endif
					    </div>
					</div>

                    
                </div>
			</div>
		</section>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/Chart.js')}}"></script>
<script>
    $(function(){
        var plt_data = <?php echo $plt_value; ?>;

        var barChartData = {
            labels: <?php echo $plt_value; ?>,
            datasets: [{
                label: 'PLT',
                pointStyle: 'line',
                backgroundColor : "rgba(0,255,0,0.5)",
                data: plt_data
            }]
        };

        var ctx = document.getElementById("plt-chart").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'line',
            data: barChartData
        });
    });

    $(function(){
        var rbc_data = <?php echo $rbc_value; ?>;

        var barChartData2 = {
            labels: <?php echo $rbc_value; ?>,
            datasets: [{
                label: 'RBC',
                pointStyle: 'line',
                backgroundColor : "rgba(255,0,0,0.5)",
                data: rbc_data
            }]
        };

        var ctx = document.getElementById("rbc-chart").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'line',
            data: barChartData2
        });
    });

    $(function(){
        var wbc_data = <?php echo $wbc_value; ?>;

        var barChartData3 = {
            labels: <?php echo $wbc_value; ?>,
            datasets: [{
                label: 'WBC',
                pointStyle: 'line',
                backgroundColor : "rgba(255,255,0,0.5)",
                data: wbc_data
            }]
        };

        var ctx = document.getElementById("wbc-chart").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'line',
            data: barChartData3
        });
    });
</script>
@endsection