@extends('layouts.public')

@section('content')
<header class="page-header">
    <h2>Hasil Lab - <span style="color:#dc1b30;">{{$result->no_lab}} - {{$result->nama}}</span></h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li><a href="{{route('result.summary.index')}}">Hasil Lab</a></li>
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
<div class="col-md-8">
    <table class="table table-striped table-responsive">
        <tr>
            <th>Tanggal</th>
            <td>@if(isset($result->created_at))
                {{ date('d F Y', strtotime($result->created_at)) }}
                @endif
            </td>
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

    @if(Auth::user()->roles == 'officer' && $result->kd_pemeriksa != '1')
    <a href="javascript:;" data-toggle="modal" data-target="#input_detail" class="btn btn-sm btn-primary"> Input Hasil
        Lab Manual</a>
    <a href="{{route('result.SendResultVerifikator', $result->id)}}" class="btn btn-sm btn-primary">Kirim ke Dokter
        ACC</a>
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
                @if(Auth::user()->roles == 'doctor' && $rd->kd_acc != '1' && $result->kd_pemeriksa == '1')
                <a href="{{route('result.getValidateResult', $rd->id)}}">Validasi</a>
                @elseif(Auth::user()->roles == 'officer' && $result->kd_pemeriksa != '1')
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
<div class="col-md-4">
    @php
    $x_pltvalue = isset($result->histogram->plt_value)?$result->histogram->plt_value:0;
    $sanitize_x_pltvalue = str_replace('[', '', $x_pltvalue);
    $sanitize_x_pltvalue2 = str_replace(']', '', $sanitize_x_pltvalue);
    $array_x_pltvalue = explode(',', $sanitize_x_pltvalue2);
    $plt_graph_setting['y_max'] = 30;
    $plt_graph_setting['count_x'] = count($array_x_pltvalue);
    $plt_graph_setting['graph_width'] = 400;
    $plt_graph_setting['graph_height'] = 150;
    $plt_graph_setting['graph_canvas_height'] = $plt_graph_setting['graph_height']+20;
    $plt_graph_setting['y_divider'] = 3;
    $plt_graph_setting['x_index_skipper'] = 3;
    $plt_graph_setting['x_legend_position_adjustment'] = 2;
    $plt_graph_setting['graph_padding_left'] = 20;
    $plt_graph_setting['legend_y_padding_top'] = 10;
    $plt_graph_setting['value_multiplier'] = $plt_graph_setting['graph_height']/$plt_graph_setting['y_max'];

    $x_rbcvalue = isset($result->histogram->rbc_value)?$result->histogram->rbc_value:0;
    $sanitize_x_rbcvalue = str_replace('[', '', $x_rbcvalue);
    $sanitize_x_rbcvalue2 = str_replace(']', '', $sanitize_x_rbcvalue);
    $array_x_rbcvalue = explode(',', $sanitize_x_rbcvalue2);

    $rbc_graph_setting['y_max'] = 300;
    $rbc_graph_setting['count_x'] = count($array_x_rbcvalue);
    $rbc_graph_setting['graph_width'] = 400;
    $rbc_graph_setting['graph_height'] = 150;
    $rbc_graph_setting['graph_canvas_height'] = $rbc_graph_setting['graph_height']+20;
    $rbc_graph_setting['y_divider'] = 3;
    $rbc_graph_setting['x_index_skipper'] = 5;
    $rbc_graph_setting['x_legend_position_adjustment'] = 2;
    $rbc_graph_setting['graph_padding_left'] = 20;
    $rbc_graph_setting['legend_y_padding_top'] = 10;
    $rbc_graph_setting['value_multiplier'] = $rbc_graph_setting['graph_height']/$rbc_graph_setting['y_max'];

    $x_wbcvalue = isset($result->histogram->wbc_value)?$result->histogram->wbc_value:0;
    $sanitize_x_wbcvalue = str_replace('[', '', $x_wbcvalue);
    $sanitize_x_wbcvalue2 = str_replace(']', '', $sanitize_x_wbcvalue);
    $array_x_wbcvalue = explode(',', $sanitize_x_wbcvalue2);

    $wbc_graph_setting['y_max'] = 50;
    $wbc_graph_setting['count_x'] = count($array_x_wbcvalue);
    $wbc_graph_setting['graph_width'] = 400;
    $wbc_graph_setting['graph_height'] = 150;
    $wbc_graph_setting['graph_canvas_height'] = $wbc_graph_setting['graph_height']+20;
    $wbc_graph_setting['y_divider'] = 5;
    $wbc_graph_setting['x_index_skipper'] = 3;
    $wbc_graph_setting['x_legend_position_adjustment'] = 2;
    $wbc_graph_setting['graph_padding_left'] = 20;
    $wbc_graph_setting['legend_y_padding_top'] = 10;
    $wbc_graph_setting['value_multiplier'] = $wbc_graph_setting['graph_height']/$wbc_graph_setting['y_max'];
    @endphp
    @if($result->histogram)
    <div style="margin-bottom:10px;"><span style="background:rgba(0, 255, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>PLT</div>
    <canvas id="plt-chart" height="{{ $plt_graph_setting['graph_canvas_height'] }}" width="{{$plt_graph_setting['graph_width']}}"></canvas>
    <div style="margin-top:25px;margin-bottom:10px;"><span style="background:rgba(255, 0, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>RBC</div>
    <canvas id="rbc-chart" height="{{ $rbc_graph_setting['graph_canvas_height'] }}" width="{{$rbc_graph_setting['graph_width']}}"></canvas>
    <div style="margin-top:25px;margin-bottom:10px;"><span style="background:rgba(255, 255, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>RBC</div>
    <canvas id="wbc-chart" height="<?php echo $wbc_graph_setting['graph_canvas_height'];?>" width="<?php echo $wbc_graph_setting['graph_width'];?>"></canvas>

    <!--    <canvas id="rbc-chart" height="200"></canvas>-->
<!--    <canvas id="wbc-chart" height="200"></canvas>-->
    @else
    <i class="fa fa-fw fa-info-circle text-primary"></i> Data Histogram Tidak Ditemukan
    @endif
</div>
</div>
@else
<i class="fa fa-fw fa-info-circle text-primary"></i> Data Tidak Ditemukan
@endif


{{-- MODALS DETAIL --}}
<div class="modal fade" id="input_detail" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
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
                ->fromQuery(App\Models\Kdlab::where('status', '1')->whereNotIn('id',
                App\Models\ResultDetail::where('id_master', $result->id)->get(['id_lab']))->orderBy('id','ASC')->get(),
                'nama', 'id')->required() !!}
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
</div>
</div>
</section>
</div>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="{{asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('scripts')
<script src="{{asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('js/Chart.js')}}"></script>

<script>
    var c = document.getElementById("plt-chart");
    var ctx = c.getContext("2d");
    ctx.beginPath();
    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>, 0);
    ctx.lineTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
    ctx.lineTo(<?php echo $plt_graph_setting['graph_width'] + $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>, 0);
    ctx.lineTo(<?php echo $plt_graph_setting['graph_width'];?>, 0);
    ctx.stroke();

    /* HORIZONTAL RULER */
    <?php
    for ($i = 0; $i < $plt_graph_setting['y_divider']; $i++) {
        ?>
    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo ($i + 1) * ($plt_graph_setting['graph_height'] / $plt_graph_setting['y_divider']) ?>);
    ctx.lineTo(<?php echo $plt_graph_setting['graph_width'];?>,<?php echo ($i + 1) * ($plt_graph_setting['graph_height'] / $plt_graph_setting['y_divider']) ?>);
        <?php
    }
    ?>
    ctx.strokeStyle = "#d6d4d4";
    ctx.stroke();

    /* VERTICAL RULER */
    <?php
    for ($i = 0; $i < $plt_graph_setting['count_x']; $i = $i + $plt_graph_setting['x_index_skipper']) {
        ?>
    ctx.moveTo( <?php echo ((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) + $plt_graph_setting['graph_padding_left']);?> , 0);
    ctx.lineTo( <?php echo ((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) + $plt_graph_setting['graph_padding_left']);?> , <?php echo $plt_graph_setting['graph_height'];?>);
        <?php
    }
    ?>
    ctx.strokeStyle = "#d6d4d4";
    ctx.stroke();


    /* LEGEND X */
    ctx.beginPath();
    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
    <?php
    for ($i = 0; $i < $plt_graph_setting['count_x']; $i = $i + $plt_graph_setting['x_index_skipper']) {
        ?>
    ctx.fillText("<?php echo $array_x_pltvalue[$i]; ?>",<?php echo (((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) - $plt_graph_setting['x_legend_position_adjustment']) + $plt_graph_setting['graph_padding_left']);?>,<?php echo $plt_graph_setting['graph_canvas_height'];?>);
        <?php
    }
    ?>

    /* LEGEND Y */
    <?php
    for ($i = 0; $i <= $plt_graph_setting['y_divider']; $i++) {
        if ($i < $plt_graph_setting['y_divider']) {
            ?>
        ctx.fillText("<?php echo($plt_graph_setting['y_max'] - ($i * $plt_graph_setting['y_max'] / $plt_graph_setting['y_divider']));?>", 0,<?php echo (($i * $plt_graph_setting['graph_height'] / $plt_graph_setting['y_divider']) + $plt_graph_setting['legend_y_padding_top']); ?>);
            <?php
        }
    }
    ?>
    ctx.strokeStyle = "#d6d4d4";
    ctx.stroke();

    /* VALUE */
    ctx.beginPath();
    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
    <?php

    for ($i = 0; $i < $plt_graph_setting['count_x']; $i++) {
        $default_pltvalue = $array_x_pltvalue[$i];
        $reverse_pltvalue = $plt_graph_setting['graph_height'] - ($default_pltvalue * $plt_graph_setting['value_multiplier']);
        $last_i = $i;
        ?>
    ctx.lineTo( <?php echo ((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) + $plt_graph_setting['graph_padding_left']);?> , <?php echo $reverse_pltvalue; ?> );
        <?php
    }
    ?>
    ctx.lineTo( <?php echo $plt_graph_setting['graph_width'];?>, <?php echo $plt_graph_setting['graph_height']; ?> );
    ctx.stroke();
    ctx.fillStyle = "rgba(0, 255, 0, 0.6)";
    ctx.fill();

</script>


<script>
    var c = document.getElementById("rbc-chart");
    var ctx = c.getContext("2d");
    ctx.beginPath();
    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,0);
    ctx.lineTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
    ctx.lineTo(<?php echo $rbc_graph_setting['graph_width']+$rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,0);
    ctx.lineTo(<?php echo $rbc_graph_setting['graph_width'];?>,0);
    ctx.stroke();

    /* HORIZONTAL RULER */
    <?php
    for( $i=0;$i<$rbc_graph_setting['y_divider'];$i++ ){
        ?>
    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo ($i+1)*($rbc_graph_setting['graph_height']/$rbc_graph_setting['y_divider']) ?>);
    ctx.lineTo(<?php echo $rbc_graph_setting['graph_width'];?>,<?php echo ($i+1)*($rbc_graph_setting['graph_height']/$rbc_graph_setting['y_divider']) ?>);
        <?php
    }
    ?>
    ctx.strokeStyle="#d6d4d4";
    ctx.stroke();

    /* VERTICAL RULER */
    <?php
    for( $i=0;$i<$rbc_graph_setting['count_x'];$i=$i+$rbc_graph_setting['x_index_skipper'] ){
        ?>
    ctx.moveTo( <?php echo ((($i)*($rbc_graph_setting['graph_width']/$rbc_graph_setting['count_x']))+$rbc_graph_setting['graph_padding_left']);?> , 0);
    ctx.lineTo( <?php echo ((($i)*($rbc_graph_setting['graph_width']/$rbc_graph_setting['count_x']))+$rbc_graph_setting['graph_padding_left']);?> , <?php echo $rbc_graph_setting['graph_height'];?>);
        <?php
    }
    ?>
    ctx.strokeStyle="#d6d4d4";
    ctx.stroke();


    /* LEGEND X */
    ctx.beginPath();
    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
    <?php
    for( $i=0;$i<$rbc_graph_setting['count_x'];$i=$i+$rbc_graph_setting['x_index_skipper'] ){
        ?>
    ctx.fillText("<?php echo $array_x_rbcvalue[$i]; ?>",<?php echo (((($i)*($rbc_graph_setting['graph_width']/$rbc_graph_setting['count_x']))-$rbc_graph_setting['x_legend_position_adjustment'])+$rbc_graph_setting['graph_padding_left']);?>,<?php echo $rbc_graph_setting['graph_canvas_height'];?>);
        <?php
    }
    ?>

    /* LEGEND Y */
    <?php
    for( $i=0;$i<=$rbc_graph_setting['y_divider'];$i++ ){
        if( $i < $rbc_graph_setting['y_divider'] ){
            ?>
        ctx.fillText("<?php echo($rbc_graph_setting['y_max']-($i*$rbc_graph_setting['y_max']/$rbc_graph_setting['y_divider'])) ;?>",0,<?php echo (($i*$rbc_graph_setting['graph_height']/$rbc_graph_setting['y_divider'])+$rbc_graph_setting['legend_y_padding_top']); ?>);
            <?php
        }
    }
    ?>
    ctx.strokeStyle="#d6d4d4";
    ctx.stroke();

    /* VALUE */
    ctx.beginPath();
    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
    <?php
    for( $i=0;$i<$rbc_graph_setting['count_x'];$i++ ){

        $default_rbcvalue = $array_x_rbcvalue[$i];
        $reverse_rbcvalue = $rbc_graph_setting['graph_height'] - ($default_rbcvalue*$rbc_graph_setting['value_multiplier']);
        $last_i = $i;
        ?>
    ctx.lineTo( <?php echo ((($i)*($rbc_graph_setting['graph_width']/$rbc_graph_setting['count_x']))+$rbc_graph_setting['graph_padding_left']);?> , <?php echo $reverse_rbcvalue; ?> );
        <?php
    }
    ?>
    ctx.lineTo( <?php echo $rbc_graph_setting['graph_width'];?>, <?php echo $rbc_graph_setting['graph_height']; ?> );
    ctx.stroke();
    ctx.fillStyle = "rgba(255, 0, 0, 0.6)";
    ctx.fill();

</script>




<script>
    var c = document.getElementById("wbc-chart");
    var ctx = c.getContext("2d");
    ctx.beginPath();
    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,0);
    ctx.lineTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
    ctx.lineTo(<?php echo $wbc_graph_setting['graph_width']+$wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,0);
    ctx.lineTo(<?php echo $wbc_graph_setting['graph_width'];?>,0);
    ctx.stroke();

    /* HORIZONTAL RULER */
    <?php
    for( $i=0;$i<$wbc_graph_setting['y_divider'];$i++ ){
        ?>
    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo ($i+1)*($wbc_graph_setting['graph_height']/$wbc_graph_setting['y_divider']) ?>);
    ctx.lineTo(<?php echo $wbc_graph_setting['graph_width'];?>,<?php echo ($i+1)*($wbc_graph_setting['graph_height']/$wbc_graph_setting['y_divider']) ?>);
        <?php
    }
    ?>
    ctx.strokeStyle="#d6d4d4";
    ctx.stroke();

    /* VERTICAL RULER */
    <?php
    for( $i=0;$i<$wbc_graph_setting['count_x'];$i=$i+$wbc_graph_setting['x_index_skipper'] ){
        ?>
    ctx.moveTo( <?php echo ((($i)*($wbc_graph_setting['graph_width']/$wbc_graph_setting['count_x']))+$wbc_graph_setting['graph_padding_left']);?> , 0);
    ctx.lineTo( <?php echo ((($i)*($wbc_graph_setting['graph_width']/$wbc_graph_setting['count_x']))+$wbc_graph_setting['graph_padding_left']);?> , <?php echo $wbc_graph_setting['graph_height'];?>);
        <?php
    }
    ?>
    ctx.strokeStyle="#d6d4d4";
    ctx.stroke();


    /* LEGEND X */
    ctx.beginPath();
    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
    <?php
    for( $i=0;$i<$wbc_graph_setting['count_x'];$i=$i+$wbc_graph_setting['x_index_skipper'] ){
        ?>
    ctx.fillText("<?php echo $array_x_wbcvalue[$i]; ?>",<?php echo (((($i)*($wbc_graph_setting['graph_width']/$wbc_graph_setting['count_x']))-$wbc_graph_setting['x_legend_position_adjustment'])+$wbc_graph_setting['graph_padding_left']);?>,<?php echo $wbc_graph_setting['graph_canvas_height'];?>);
        <?php
    }
    ?>

    /* LEGEND Y */
    <?php
    for( $i=0;$i<=$wbc_graph_setting['y_divider'];$i++ ){
        if( $i < $wbc_graph_setting['y_divider'] ){
            ?>
        ctx.fillText("<?php echo($wbc_graph_setting['y_max']-($i*$wbc_graph_setting['y_max']/$wbc_graph_setting['y_divider'])) ;?>",0,<?php echo (($i*$wbc_graph_setting['graph_height']/$wbc_graph_setting['y_divider'])+$wbc_graph_setting['legend_y_padding_top']); ?>);
            <?php
        }
    }
    ?>
    ctx.strokeStyle="#d6d4d4";
    ctx.stroke();

    /* VALUE */
    ctx.beginPath();
    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
    <?php
    for( $i=0;$i<$wbc_graph_setting['count_x'];$i++ ){

        $default_wbcvalue = $array_x_wbcvalue[$i];
        $reverse_wbcvalue = $wbc_graph_setting['graph_height'] - ($default_wbcvalue*$wbc_graph_setting['value_multiplier']);
        $last_i = $i;
        ?>
    ctx.lineTo( <?php echo ((($i)*($wbc_graph_setting['graph_width']/$wbc_graph_setting['count_x']))+$wbc_graph_setting['graph_padding_left']);?> , <?php echo $reverse_wbcvalue; ?> );
        <?php
    }
    ?>
    ctx.lineTo( <?php echo $wbc_graph_setting['graph_width'];?>, <?php echo $wbc_graph_setting['graph_height']; ?> );
    ctx.stroke();
    ctx.fillStyle = "rgba(255, 255, 0, 0.6)";
    ctx.fill();

</script>
<!--<script>-->
<!---->
<!--    $(function () {-->
<!--        var wbc_data = --><?php //echo $wbc_value; ?><!--;-->
<!---->
<!--        var barChartData3 = {-->
<!--            labels: --><?php //echo $wbc_value; ?><!--,-->
<!--            datasets:[-->
<!--                {-->
<!--                    label:'WBC',-->
<!--                    pointStyle:'line',-->
<!--                    backgroundColor:"rgba(255,255,0,0.5)",-->
<!--                    data:wbc_data-->
<!--                }-->
<!--            ]-->
<!--        };-->
<!---->
<!--        var ctx = document.getElementById("wbc-chart").getContext("2d");-->
<!--        window.myBar = new Chart(ctx, {-->
<!--            type:'line',-->
<!--            data:barChartData3-->
<!--        });-->
<!--    });-->
<!--</script>-->

<script type="text/javascript">
    $('#id_lab').change(function () {
        var id_lab = this.value,
            id_master = $('#id_master').val();

        if (id_lab) {
            $.get("/getNilaiRujukan/" + id_lab + "/" + id_master, function (data) {
                $('#rujukan_awal').val(data['nr_1']);
                $('#rujukan_akhir').val(data['nr_2']);
            });

            $.get("/getLabDetail/" + id_lab, function (data) {
                $('#satuan').val(data['satuan']);
                $('#metoda').val(data['metoda']);
            });
        }

    });
</script>
@endsection