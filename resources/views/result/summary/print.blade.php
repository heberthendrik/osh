<style media="screen">
    .header {
        text-align: center;
    }

    .text {
        font-size: 10;
    }

    .table-title {
        width: 100%;
    }

    .table-title th {
        text-align: left;
    }

    .table-title td {
        text-align: left;
    }

    .table-content {
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
    }

    .table-content th {
        padding: 5px;
        border: 1px solid black;
        text-align: center;
    }

    .table-content td {
        padding: 5px;
        border: 1px solid black;
        text-align: center;
    }
</style>
<body>
<div class="header"><h1>HASIL PEMERIKSAAN LABORATORIUM</h1></div>
<div class="text">
    <table class="table-title">
        <tr>
            <th width="10px">Nama</th>
            <td width="20px">{{$result->nama}}</td>
            <th width="10px">No. Lab</th>
            <td width="20px">{{$result->no_lab}}</td>
        </tr>
        <tr>
            <th>No. Rekam Medis</th>
            <td>{{$result->no_rm}}</td>
            <th>Dokter Pengirim</th>
            <td>{{$result->nm_dokter}}</td>
        </tr>
        <tr>
            <th>Umur</th>
            <td>{{$result->umur}} {{$result->umur_sat}}
                <th>Tanggal Terima</th>
            <td width="20px">{{ date('d F Y', strtotime($result->created_at)) }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{$result->alamat}}</td>
            <th>Ruang / Poli</th>
            <td>{{$result->nm_ruang}}</td>
        </tr>
    </table>
    <div class="col-md-9" style="width: 70%;float: left;">

        <table class="table-content">
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
    <div class="col-md-3" style="width: 30%;float: right;">
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

<script src="{{asset('js/Chart.js')}}"></script>
<script>
    var plt_data = <?php echo $plt_value; ?>;

    var barChartData = {
        labels: <?php echo $plt_value; ?>,
        datasets:[
            {
                label:'PLT',
                pointStyle:'line',
                backgroundColor:"rgba(0,255,0,0.5)",
                data:plt_data
            }
        ]
    };

    var ctx = document.getElementById("plt-chart").getContext("2d");
    window.myBar = new Chart(ctx, {
        type:'line',
        data:barChartData
    });

    var rbc_data = <?php echo $rbc_value; ?>;

    var barChartData2 = {
        labels: <?php echo $rbc_value; ?>,
        datasets:[
            {
                label:'RBC',
                pointStyle:'line',
                backgroundColor:"rgba(255,0,0,0.5)",
                data:rbc_data
            }
        ]
    };

    var ctx = document.getElementById("rbc-chart").getContext("2d");
    window.myBar = new Chart(ctx, {
        type:'line',
        data:barChartData2
    });

    var wbc_data = <?php echo $wbc_value; ?>;

    var barChartData3 = {
        labels: <?php echo $wbc_value; ?>,
        datasets:[
            {
                label:'WBC',
                pointStyle:'line',
                backgroundColor:"rgba(255,255,0,0.5)",
                data:wbc_data
            }
        ]
    };

    var ctx = document.getElementById("wbc-chart").getContext("2d");
    window.myBar = new Chart(ctx, {
        type:'line',
        data:barChartData3
    });
</script>
</body>