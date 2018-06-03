<?php
$site_url = 'http://localhost/development_site/osh';

//$_GET['lid'] = '1803120001';

$host = "localhost";
$port = "5432";
$dbname = "ehealth";
$user = "postgres";
$password = "password";
$pg_options = "--client_encoding=UTF8";

$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} options='{$pg_options}'";
$dbconn = pg_connect($connection_string);


/* AMBIL DATA PASIEN */
$result = pg_query($dbconn, "SELECT * FROM tab_lab_master where id = '".$_GET['lid']."' ");
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$drr = pg_fetch_all($result);
$x_tanggal = $drr[0]['created_at'];
$x_nolab = $drr[0]['id'];
$x_norm = $drr[0]['no_rm'];
$x_nama = $drr[0]['nama'];
$x_tanggallahir = $drr[0]['tgl_lahir'];
$x_umur = $drr[0]['umur'];
$x_alamat = $drr[0]['alamat'];
$x_ruang = $drr[0]['nm_ruang'];
$x_kelas = $drr[0]['nm_kelas'];
$x_status = $drr[0]['nm_status'];
$x_dokterpengirim = $drr[0]['nm_dokter'];
$x_alamatdokter = $drr[0]['alamat_dokter'];
$x_ketklinik = $drr[0]['ket_klinik'];
$x_catatan1 = $drr[0]['catatan_1'];
$x_catatan2 = $drr[0]['catatan_2'];
$x_dokteracc = $drr[0]['nm_dokter_acc'];
$x_pemeriksa = $drr[0]['nm_pemeriksa'];

/* table */


/* AMBIL DATA HISTOGRAM */
$result = pg_query($dbconn, "SELECT * FROM tab_lab_histogram where id = '".$_GET['lid']."' ");
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$arr = pg_fetch_all($result);
$x_id = $arr[0]['id'];
$x_idmaster = $arr[0]['id_master'];
$x_pltvalue = $arr[0]['plt_value'];
$x_rbcvalue = $arr[0]['rbc_value'];
$x_wbcvalue = $arr[0]['wbc_value'];


?>
<!doctype html>
<html class="fixed sidebar-light">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/morris.js/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo $site_url;?>/public/hebert_admin/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/modernizr/modernizr.js"></script>
    
	</head>
	<body>
		<section class="body" style="padding:20px;">
		
		
		
		<div class="row">
			<div class="col-md-12">
				<section class="panel">
					<header class="panel-heading">
						<div class="row">					
							<h2 class="panel-title" style="padding-left:15px;"><?php echo $x_id;?> - Zulkifli</h2>
							<div class="pull-right" style="padding-right:20px;float:right;position:absolute;right:0;top:0;margin-top:15px;">
<!-- 								{!! DNS1D::getBarcodeHTML($result->no_lab, "C128", '1','30')!!} -->
							</div>
						</div>
					</header>
					<div class="panel-body">
						<div class="box-body">
		                    
		                    
							<div class="row">
							    <div class="col-md-8">
							        <table class="table table-striped table-responsive">
							            <tr>
							                <th>Tanggal</th>
							                <td><?php echo $x_tanggal;?></td>
							                <th>No. Lab</th>
							                <td><?php echo $x_id;?></td>
							                <th>Status</th>
							                <td><?php echo $x_status;?></td>
							            </tr>
							            <tr>
							                <th>No. Rekam Medis</th>
							                <td colspan="3"><?php echo $x_norm;?></td>
							                <th>Dokter Pengirim</th>
							                <td><?php echo $x_dokterpengirim;?></td>
							            </tr>
							            <tr>
							                <th>Nama</th>
							                <td colspan="3"><?php echo $x_nama;?></td>
							                <th>Alamat Dokter</th>
							                <td><?php echo $x_alamatdokter;?></td>
							            </tr>
							            <tr>
							                <th>Tanggal Lahir</th>
							                <td colspan="3"><?php echo $x_tanggallahir;?></td>
							                <th>Ket Klinik</th>
							                <td><?php echo $x_ketklinik;?></td>
							            </tr>
							            <tr>
							                <th>Umur</th>
							                <td colspan="3"><?php echo $x_umur;?></td>
							                <th>Catatan 1</th>
							                <td><?php echo $x_catatan1;?></td>
							            </tr>
							            <tr>
							                <th>Alamat</th>
							                <td colspan="3"><?php echo $x_alamat;?></td>
							                <th>Catatan 2</th>
							                <td><?php echo $x_catatan2;?></td>
							            </tr>
							            <tr>
							                <th>Ruang</th>
							                <td colspan="3"><?php echo $x_ruang;?></td>
							                <th>Dokter ACC</th>
							                <td><?php echo $x_dokteracc;?></td>
							            </tr>
							            <tr>
							                <th>Kelas</th>
							                <td colspan="3"><?php echo $x_kelas;?></td>
							                <th>Pemeriksa</th>
							                <td><?php echo $x_pemeriksa;?></td>
							            </tr>
							        </table>
							
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
							            
							            <tbody>
											<tr>
												<td>
													Hemoglobin                                                                                          
												</td>
												<td style="color:green;"><b>14.9</b></td>
												<td>11.5-16.5</td>
												<td>g/dL</td>
												<td>
												</td>
												<td>
													RDW-CV                                                                                              
												</td>
												<td style="color:green;"><b>16.4</b></td>
												<td>11.0-16.0</td>
												<td>%</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
													Eritrosit                                                                                           
												</td>
												<td style="color:green;"><b>4.73</b></td>
												<td>3.50-5.50</td>
												<td>10*12/L</td>
												<td>
												</td>
												<td>
													Trombosit                                                                                           
												</td>
												<td style="color:green;"><b>214</b></td>
												<td>130-400</td>
												<td>10*9/L</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
													MPV                                                                                                 
												</td>
												<td style="color:green;"><b>9.6</b></td>
												<td>6.5-11.0</td>
												<td>fL</td>
												<td>
												</td>
												<td>
													PDW                                                                                                 
												</td>
												<td style="color:green;"><b>51.8</b></td>
												<td>0.1-99.9</td>
												<td>%</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
													P - LCR                                                                                             
												</td>
												<td style="color:green;"><b>27.1</b></td>
												<td>0.1-99.9</td>
												<td>%</td>
												<td>
												</td>
												<td>
													RDW-SD                                                                                              
												</td>
												<td style="color:green;"><b>87.0</b></td>
												<td>0.1-250.0</td>
												<td>fL</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
													Limfosit%                                                                                           
												</td>
												<td style="color:green;"><b>34.8</b></td>
												<td>15.0-50.0</td>
												<td>%</td>
												<td>
												</td>
												<td>
													Limfosit#                                                                                           
												</td>
												<td style="color:green;"><b>2.3</b></td>
												<td>0.9-5.0</td>
												<td>10*9/L</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
													MCV                                                                                                 
												</td>
												<td style="color:green;"><b>113.9</b></td>
												<td>75.0-100.0</td>
												<td>fL</td>
												<td>
												</td>
												<td>
													MCH                                                                                                 
												</td>
												<td style="color:green;"><b>31.6</b></td>
												<td>25.0-35.0</td>
												<td>pg</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
													MCHC                                                                                                
												</td>
												<td style="color:green;"><b>27.7</b></td>
												<td>31.0-38.0</td>
												<td>g/dL</td>
												<td>
												</td>
												<td>
													Hematokrit                                                                                          
												</td>
												<td style="color:green;"><b>53.9</b></td>
												<td>35.0-55.0</td>
												<td>%</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
													Leukosit                                                                                            
												</td>
												<td style="color:green;"><b>6.6</b></td>
												<td>3.5-10.0</td>
												<td>10*9/L</td>
												<td>
												</td>
												<td>
													PCT                                                                                                 
												</td>
												<td style="color:green;"><b>0.20</b></td>
												<td>0.01-9.99</td>
												<td>%</td>
												<td>
												</td>
											</tr>
										</tbody>
							            
							        </table>
							    </div>
							    <div class="col-md-4">
							        
							        	<?php
										$x_pltvalue = $arr[0]['plt_value'];
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
							        	?>
							        	<div style="margin-bottom:10px;"><span style="background:rgba(0, 255, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>PLT</div>
							            <canvas id="plt-chart" height="<?php echo $plt_graph_setting['graph_canvas_height'];?>" width="<?php echo $plt_graph_setting['graph_width'];?>"></canvas>
							            <script>
											var c = document.getElementById("plt-chart");
											var ctx = c.getContext("2d");
											ctx.beginPath();
											ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,0);
											ctx.lineTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
											ctx.lineTo(<?php echo $plt_graph_setting['graph_width']+$plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
											ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,0);
											ctx.lineTo(<?php echo $plt_graph_setting['graph_width'];?>,0);
											ctx.stroke();
											
											/* HORIZONTAL RULER */
											<?php
											for( $i=0;$i<$plt_graph_setting['y_divider'];$i++ ){
												?>
												ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo ($i+1)*($plt_graph_setting['graph_height']/$plt_graph_setting['y_divider']) ?>);
												ctx.lineTo(<?php echo $plt_graph_setting['graph_width'];?>,<?php echo ($i+1)*($plt_graph_setting['graph_height']/$plt_graph_setting['y_divider']) ?>);
												<?php
											}
											?>
											ctx.strokeStyle="#d6d4d4";
											ctx.stroke();
											
											/* VERTICAL RULER */
											<?php
											for( $i=0;$i<$plt_graph_setting['count_x'];$i=$i+$plt_graph_setting['x_index_skipper'] ){
												?>
												ctx.moveTo( <?php echo ((($i)*($plt_graph_setting['graph_width']/$plt_graph_setting['count_x']))+$plt_graph_setting['graph_padding_left']);?> , 0);
												ctx.lineTo( <?php echo ((($i)*($plt_graph_setting['graph_width']/$plt_graph_setting['count_x']))+$plt_graph_setting['graph_padding_left']);?> , <?php echo $plt_graph_setting['graph_height'];?>);
												<?php
											}
											?>
											ctx.strokeStyle="#d6d4d4";
											ctx.stroke();
											
											
											/* LEGEND X */
											ctx.beginPath();
											ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
											<?php
											for( $i=0;$i<$plt_graph_setting['count_x'];$i=$i+$plt_graph_setting['x_index_skipper'] ){
												?>
												ctx.fillText("<?php echo $array_x_pltvalue[$i]; ?>",<?php echo (((($i)*($plt_graph_setting['graph_width']/$plt_graph_setting['count_x']))-$plt_graph_setting['x_legend_position_adjustment'])+$plt_graph_setting['graph_padding_left']);?>,<?php echo $plt_graph_setting['graph_canvas_height'];?>);
												<?php
											}
											?>
											
											/* LEGEND Y */
											<?php
											for( $i=0;$i<=$plt_graph_setting['y_divider'];$i++ ){
												if( $i < $plt_graph_setting['y_divider'] ){
													?>
													ctx.fillText("<?php echo($plt_graph_setting['y_max']-($i*$plt_graph_setting['y_max']/$plt_graph_setting['y_divider'])) ;?>",0,<?php echo (($i*$plt_graph_setting['graph_height']/$plt_graph_setting['y_divider'])+$plt_graph_setting['legend_y_padding_top']); ?>);
													<?php	
												}
											}
											?>
											ctx.strokeStyle="#d6d4d4";
											ctx.stroke();
											
											/* VALUE */
											ctx.beginPath();
											ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
											<?php
											for( $i=0;$i<=$plt_graph_setting['count_x'];$i++ ){
												
												$default_pltvalue = $array_x_pltvalue[$i];
												$reverse_pltvalue = $plt_graph_setting['graph_height'] - ($default_pltvalue*$plt_graph_setting['value_multiplier']);
												$last_i = $i;
												?>
												ctx.lineTo( <?php echo ((($i)*($plt_graph_setting['graph_width']/$plt_graph_setting['count_x']))+$plt_graph_setting['graph_padding_left']);?> , <?php echo $reverse_pltvalue; ?> );
												<?php
											}
											?>
											ctx.stroke();
											ctx.fillStyle = "rgba(0, 255, 0, 0.6)";
											ctx.fill();
											
										</script>




										<?php
										$x_rbcvalue = $arr[0]['rbc_value'];
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
										$plt_graph_setting['value_multiplier'] = $rbc_graph_setting['graph_height']/$rbc_graph_setting['y_max'];
							        	?>
							        	<div style="margin-top:25px;margin-bottom:10px;"><span style="background:rgba(255, 0, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>RBC</div>
							            <canvas id="rbc-chart" height="<?php echo $plt_graph_setting['graph_canvas_height'];?>" width="<?php echo $rbc_graph_setting['graph_width'];?>"></canvas>
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
											for( $i=0;$i<=$rbc_graph_setting['count_x'];$i++ ){
												
												$default_rbcvalue = $array_x_rbcvalue[$i];
												$reverse_rbcvalue = $rbc_graph_setting['graph_height'] - ($default_rbcvalue*$plt_graph_setting['value_multiplier']);
												$last_i = $i;
												?>
												ctx.lineTo( <?php echo ((($i)*($rbc_graph_setting['graph_width']/$rbc_graph_setting['count_x']))+$rbc_graph_setting['graph_padding_left']);?> , <?php echo $reverse_rbcvalue; ?> );
												<?php
											}
											?>
											ctx.stroke();
											ctx.fillStyle = "rgba(255, 0, 0, 0.6)";
											ctx.fill();
											
										</script>




										<?php
										$x_wbcvalue = $arr[0]['wbc_value'];
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
										$plt_graph_setting['value_multiplier'] = $wbc_graph_setting['graph_height']/$wbc_graph_setting['y_max'];
							        	?>
							        	<div style="margin-top:25px;margin-bottom:10px;"><span style="background:rgba(255, 255, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>RBC</div>
							            <canvas id="wbc-chart" height="<?php echo $plt_graph_setting['graph_canvas_height'];?>" width="<?php echo $wbc_graph_setting['graph_width'];?>"></canvas>
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
											for( $i=0;$i<=$wbc_graph_setting['count_x'];$i++ ){
												
												$default_wbcvalue = $array_x_wbcvalue[$i];
												$reverse_wbcvalue = $wbc_graph_setting['graph_height'] - ($default_wbcvalue*$plt_graph_setting['value_multiplier']);
												$last_i = $i;
												?>
												ctx.lineTo( <?php echo ((($i)*($wbc_graph_setting['graph_width']/$wbc_graph_setting['count_x']))+$wbc_graph_setting['graph_padding_left']);?> , <?php echo $reverse_wbcvalue; ?> );
												<?php
											}
											?>
											ctx.stroke();
											ctx.fillStyle = "rgba(255, 255, 0, 0.6)";
											ctx.fill();
											
										</script>

							            							        
							    </div>
							</div>
							
		                </div>
					</div>
				</section>
			</div>
		</div>





			

			
				

							

		</section>

		<!-- Vendor -->
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jquery/jquery.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jquery-ui/jquery-ui.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
<!-- 		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jquery-appear/jquery-appear.js"></script> -->
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/flot/jquery.flot.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/flot.tooltip/flot.tooltip.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jquery-sparkline/jquery-sparkline.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/raphael/raphael.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/morris.js/morris.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/gauge/gauge.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/snap.svg/snap.svg.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqvmap/jquery.vmap.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/javascripts/theme.init.js"></script>

		<!-- Examples -->
		<script src="<?php echo $site_url;?>/public/hebert_admin/assets/javascripts/dashboard/examples.dashboard.js"></script>

	</body>
</html>