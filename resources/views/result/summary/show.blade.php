@extends('layouts.public')

@section('content')
<section class="content-header">
    <h1>
        Hasil Lab
        <small>{{$result->no_lab}} - {{$result->nama}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="{{route('result.summary.index')}}">Hasil Lab</a></li>
        <li class="active">Detil</li>
    </ol>
</section>

<section class="invoice">
<div class="row">
    <div class="col-xs-12">
        <h2 class="page-header">
            {{$result->no_lab}} - {{$result->nama}}
            <div class="pull-right">
                {!! DNS1D::getBarcodeHTML($result->no_lab, "C128", '1','30')!!}
            </div>
        </h2>
    </div>
</div>
@if($result->count())
<div class="row">
    <div class="col-md-9">
        <table class="table table-striped table-responsive">
            <tr>
                <th>Tanggal</th>
                <td>@if(isset($result->created_at))
                    {{ date('d F Y', strtotime($result->created_at)) }}
                    @endif</td>
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

        @if(Auth::user()->roles == 'officer')
        <a href="javascript:;" data-toggle="modal" data-target="#input_detail" class="btn btn-sm btn-primary"> Input Hasil Lab Manual</a>
        <br/><br/>
        @endif

        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>Pemeriksaan</th>
                <th>Hasil</th>
                <th>N Rujukan</th>
                <th>Satuan</th>
                <th>Opsi</th>
                <th>Pemeriksaan</th>
                <th>Hasil</th>
                <th>N Rujukan</th>
                <th>Satuan</th>
                <th>Opsi</th>
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
                <td>
                    @if(Auth::user()->roles == 'doctor')
                    @if(!$rd->kd_acc)
                    <a href="{{route('result.getValidateResult', $rd->id)}}">Validasi</a>
                    @else
                    <a href="{{route('result.getUnvalidateResult', $rd->id)}}" class="text-danger">Batalkan Validasi</a>
                    @endif
                    @elseif(Auth::user()->roles == 'officer' && $rd->kd_acc != '1')
                    {!! Former::open(route('result.detail.destroy', $rd->id))->method('delete') !!}
                    <a href="{{route('result.detail.edit', $rd->id)}}">Edit</a>
                    &nbsp;
                    <a href="javascript:;" data-message="Anda akan menghapus data. Anda yakin?"
                       class="btn-delete text-danger">Delete</a>
                    {!! Former::close() !!}
                    @endif
                </td>
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

<!--<div class="row no-print">-->
<!--    <div class="col-xs-12">-->
<!--        <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
<!--        <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment-->
<!--        </button>-->
<!--        <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">-->
<!--            <i class="fa fa-download"></i> Generate PDF-->
<!--        </button>-->
<!--    </div>-->
<!--</div>-->

{{-- MODALS DETAIL --}}
<div class="modal fade" id="input_detail" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw icon-pencil"></i> Input Hasil Lab Manual</h4>
            </div>
            {!! Former::open(route('result.detail.store'))->method('post') !!}
            <div class="modal-body">
                {!! Former::text('id_master')->value($result->id)->readonly()->required() !!}
                {!! Former::select('id_lab')->style('width:100%;')
                ->label('Kode Lab')
                ->class('form-control select2')
                ->options([
                '' => 'Pilih Data'
                ])
                ->fromQuery(App\Models\Kdlab::where('status', '1')->whereNotIn('id', App\Models\ResultDetail::where('id_master', $result->id)->get(['id_lab']))->orderBy('id','ASC')->get(), 'nama', 'id')->required() !!}
                {!! Former::text('hasil')->required() !!}
                {!! Former::text('rujukan_awal')->required() !!}
                {!! Former::text('rujukan_akhir')->required() !!}
                {!! Former::text('satuan') !!}
                {!! Former::text('metoda') !!}
                {!! Former::select('flag')->options([
                '0' => 'Normal',
                '4' => '<=',
                '5' => '>='
                ])->required() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button class="btn btn-success">Simpan</button>
            </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>

</section>

<div class="clearfix"></div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('scripts')
<script src="{{asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
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

<script type="text/javascript">
    $('#id_lab').change(function(){
        var id_lab = this.value,
            id_master = $('#id_master').val();

        if(id_lab) {
            $.get("/getNilaiRujukan/"+id_lab+"/"+id_master, function(data){
                $('#rujukan_awal').val(data['nr_1']);
                $('#rujukan_akhir').val(data['nr_2']);
            });

            $.get("/getLabDetail/"+id_lab, function(data){
                $('#satuan').val(data['satuan']);
                $('#metoda').val(data['metoda']);
            });
        }

    });
</script>
@endsection