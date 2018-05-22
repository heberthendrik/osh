<style media="screen">
    .header{
        text-align: center;
    }
    .text{
        font-size: 10;
    }
    .table-title{
        width: 100%;
    }
    .table-title th{
        text-align: left;
    }
    .table-title td{
        text-align: left;
    }
    .table-content{
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
    }
    .table-content th{
        padding: 5px;
        border: 1px solid black;
        text-align: center;
    }
    .table-content td{
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

    <table class="table-content">
        @if($result->details->count())
        <thead>
        <tr>
            <th>Pemeriksaan</th>
            <th width="150">Hasil</th>
            <th width="150">N Rujukan</th>
            <th width="150">Satuan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result->details as $rd)
        <tr>
            <td style="text-align: left">
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
        </tr>
        @endforeach
        </tbody>
        @else
        <tbody>
        <tr>
            <td colspan="4">
                <i class="fa fa-fw fa-info-circle text-primary"></i> Belum ada hasil lab terdaftar.
            </td>
        </tr>
        </tbody>
        @endif
    </table>
</div>
