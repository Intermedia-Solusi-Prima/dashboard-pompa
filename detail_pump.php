<?php
// require_once("orc_conn.php");
$conn = oci_connect('pompa','B4nj1r_pomp4_25','dbdev.pelindo.id:1628/intranetdev');
if (!$conn) {
    $err = oci_error();
    die("Connection failed: " . $err['message']);
} else {
    // echo "Connection successful to Oracle database.";
}

$hostapi="https://pompa-api.pelindo.co.id";

$apiKbb1="/api/kbb1";
$apiKbb2="/api/kbb2";
$apiKbb3="/api/kbb3";
$apiKepanduan="/api/kepanduan";
$apiAmpenan="/api/ampenan";
$apiDeli="/api/deli";
$apiCluster3_1="/api/cluster3_1";
$apiCluster3_2="/api/cluster3_2";
$apiCluster3_3="/api/cluster3_3";
$apiTPenumpang="/api/tpenumpang";
$apiKantor="/api/kantor";
$apiBest="/api/best";
$apiRtkTimur="/api/rtktimur";
$apiPrasasti1="/api/prasasti1";
$apiPrasasti2="/api/prasasti2";
$apiCy1_1="/api/cy1_1";
$apiCy1_2="/api/cy1_2";
$apiCy1_3="/api/cy1_3";
$apiCy2="/api/cy2";
$apiCy4="/api/cy4";
$apiCluster2_1="/api/cluster2_1";
$apiCluster2_2="/api/cluster2_2";
$apiCluster2_3="/api/cluster2_3";

/* TAMPIL DATA ----------------- */
if(isset($_GET['p'])){
    $getUri=$_GET['p'];                 //Variable ID Nama Pumppit yang disesuaikan dari DB
    
    if($getUri=="kbb1"){$arr_api=array($hostapi,$apiKbb1);}
    elseif($getUri=="kbb2"){$arr_api=array($hostapi,$apiKbb2);}
    elseif($getUri=="kbb3"){$arr_api=array($hostapi,$apiKbb3);}
    elseif($getUri=="kepanduan"){$arr_api=array($hostapi,$apiKepanduan);}
    elseif($getUri=="ampenan"){$arr_api=array($hostapi,$apiAmpenan);}
    elseif($getUri=="deli"){$arr_api=array($hostapi,$apiDeli);}
    elseif($getUri=="cluster3"){
        $arr_api=array($hostapi,$apiCluster3_1);
        $arr_api2=array($hostapi,$apiCluster3_2);
        $arr_api3=array($hostapi,$apiCluster3_3);
        $vApi2=join($arr_api2);$vApi3=join($arr_api3);
    }
    elseif($getUri=="tpenumpang"){$arr_api=array($hostapi,$apiTPenumpang);}
    elseif($getUri=="kantor"){$arr_api=array($hostapi,$apiKantor);}
    elseif($getUri=="best"){$arr_api=array($hostapi,$apiBest);}
    elseif($getUri=="rtktimur"){$arr_api=array($hostapi,$apiRtkTimur);}
    elseif($getUri=="prasasti"){
        $arr_api=array($hostapi,$apiPrasasti1);
        $arr_api2=array($hostapi,$apiPrasasti2);
        $vApi2=join($arr_api2);
    }
    elseif($getUri=="cy1"){
        $arr_api=array($hostapi,$apiCy1_1);
        $arr_api2=array($hostapi,$apiCy1_2);
        $arr_api3=array($hostapi,$apiCy1_3);
        $vApi2=join($arr_api2);$vApi3=join($arr_api3);
    }
    elseif($getUri=="cy2"){$arr_api=array($hostapi,$apiCy2);}
    elseif($getUri=="cy4"){$arr_api=array($hostapi,$apiCy4);}
    elseif($getUri=="cluster2"){
        $arr_api=array($hostapi,$apiCluster2_1);
        $arr_api2=array($hostapi,$apiCluster2_2);
        $arr_api3=array($hostapi,$apiCluster2_3);
        $vApi2=join($arr_api2);$vApi3=join($arr_api3);
    }
    if(isset($arr_api)){$vApi=join($arr_api);}

    $namaIdPumppit=strtoupper($getUri);
    $sqltampil = "SELECT * FROM TB_RUMAH_PUMPPIT WHERE NAMA_PUMPPIT='$namaIdPumppit'";
    $data=oci_parse($conn,$sqltampil);
    oci_execute($data);
    $row=oci_fetch_assoc($data);
    $namId=$lok=$zon=$jml=$ipadr=$pk=$lk=$tk="";
    if($row){
        $namId=$row['NAMA_PUMPPIT'];
        $lok=$row['LOKASI_PUMPPIT'];
        $zon=$row['ZONA_PUMPPIT'];
        $jml=$row['JUMLAH_POMPA'];
        $ipadr=$row['IPADDRESS'];
        $pk=$row['PANJANG_KOLAM'];
        $lk=$row['LEBAR_KOLAM'];
        $tk=$row['TINGGI_KOLAM'];
    }
    else{$namaIdPumppit="";}
}
else{
    $namaIdPumppit=$namId=$lok=$zon=$jml=$ipadr=$pk=$lk=$tk="";
}
/* END of TAMPIL DATA ----------------- */

function showSelectedField($id,$val){
    if($id<=$val){ echo "display:;";}
    else{ echo "display:none;";}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pumpit Prasasti</title>
    <link rel="icon" type="image/x-icon" href="dist/favicon.png">
    <link rel="stylesheet" type="text/css" href="dist/fuelbar/fuelbar.css">
    <link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
    <script type="text/javascript" src="dist/bootstrap/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="dist/jquery/jquery-3.7.1.min.js"></script>
    
    <script type="text/javascript">
    
    </script>
    <style>
        
        /* NAVBAR DEPENDENCY */
		.nav-item:hover{filter:invert(90%);z-index:9;}
		.nav-item{transition: all .3s linear;}
		.dropdown:hover .dropdown-menu{display: block;margin-top: 0;}
		.dropdown .dropdown-menu{display: none;}
    </style>
</head>
<body>
    <!-- ***************** start navbar | offcanvas container ***************** -->
	<nav class="navbar navbar-expand-lg" style="background:#4c4c4c;">
		<div class="container-fluid">
			<span class="navbar-brand text-light fw-semibold" style="">
				<div><img src="dist/logo_pelindo.png" style="height:46px;"></div>
				<div style="font-size:11px;">DASHBOARD MONITORING POMPA BANJIR</div> 
			</span>
			<div class="d-flex justify-content-end align-items-center ">
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0 text-light align-items-center">
						<li class="nav-item"><!-- NOTIFICATION MENU -->
							<a class="nav-link active" aria-current="page" href="#"><img src="dist/x_bell.png"></a>
						</li>
					<div class="ms-3 me-3 vr"></div>
						<li class="nav-item"><!-- DASHBOARD MENU -->
							<a class="nav-link" href="index.php"><img src="dist/x_dashboard.png"></a>
						</li>
					<div class="ms-3 me-3 vr"></div>
						<li class="nav-item"><!-- POMPA MENU -->
							<a class="nav-link" href="daftarpompa.php"><img src="dist/x_pompa.png"></a>
						</li>
					<div class="ms-3 me-3 vr"></div>
						<li class="nav-item dropdown"><!-- REPORT MENU -->
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="dist/x_report.png"></a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#">Report Pompa</a></li>
								<li><a class="dropdown-item" href="#">Report Pumpit</a></li>
								<li><a class="dropdown-item" href="#">Report Pasut</a></li>
							</ul>
						</li>
					<div class="ms-3 me-3 vr"></div>
						<li class="nav-item dropdown"><!-- MANAGEMENT MENU -->
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="dist/x_management.png"></a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="usermgmt.php">Management User</a></li>
								<li><a class="dropdown-item" href="#">Management Pumpit</a></li>
							</ul>
						</li>
					<div class="ms-3 me-3 vr"></div>
						<li class="nav-item"><!-- USER MENU -->
							<a class="nav-link" href="#"><img src="dist/x_user.png"></a>User
						</li>
					<div class="ms-3 me-3 vr"></div>
						<li class="nav-item"><!-- LOGOUT MENU -->
							<a class="nav-link" href="#"><img src="dist/x_logout.png"></a>Logout
						</li>
					</ul>
				</div>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</div>
	</nav>
	<div class="position-relative" style="height:8px; background-color: #BF0000;"></div>
	<!-- ***************** end navbar container ***************** -->
    
    <div class="container">
	<table >
		<!--  -->
		<tr>
            <!-- SECTION FORM INPUT -->
			<td class="align-baseline" rowspan="2" style="width:468px;">
                <nav class="navbar navbar-expand-lg bg-dark" style="">
                    <div class="container">
                        <span class="navbar-brand text-light fw-bold fs-4 ps-3" style="">DETAIL PUMP PIT</span>
                        <div class="d-flex justify-content-end align-items-center ">
                            <ul class="navbar-nav me-auto  text-light align-items-center">
                                <li class="nav-item"><!-- PENCIL EDIT MENU -->
                                    <a class="nav-link fw-bold" onclick="editPumppit()" style="cursor:pointer;color:lightgreen;">Edit
                                        <svg xmlns="" width="30" height="30" fill="lightgreen" class="" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="p-4" style="background-color:#333;">
                    <form class=""  method="POST" target="_SELF" action="" id="formdetailpumppit">
                    <div class="input-group pb-2" >
                        <span class="input-group-text fw-bold" style="width: 155px;">Nama Pump Pit</span>
                        <input class="" type="hidden" name="namaid" id="namaid" value="<?= $namId; ?>">
                        <span class="form-control" style="width: 155px;"><?= $namId; ?></span>
                    </div>
                    <div class="input-group pb-2" >
                        <span class="input-group-text fw-bold" style="width: 155px;">Lokasi Pump Pit</span>
                        <input class="form-control" maxlength="60" type="text" name="lokasi" id="lokasi" value="<?= $lok; ?>" disabled >
                    </div>
                    <div class="input-group pb-2" >
                        <span class="input-group-text fw-bold" style="width: 155px;">Zona Pump Pit</span>
                        <input class="form-control" maxlength="30" type="text" name="zona" id="zona" value="<?= $zon; ?>" disabled >
                    </div>
                    <div class="input-group pb-2" >
                        <span class="input-group-text fw-bold" style="width: 155px;">IP Address</span>
                        <input class="form-control" maxlength="16" type="text" name="ipaddress" id="ipaddress" value="<?= $ipadr; ?>" disabled>
                    </div>
                    
                    <div class="input-group pb-2" >
                        <label class="input-group-text fw-bold" for="jumlah" style="width: 155px;">Jumlah Pompa</label>
                        <select class="form-select" name="jumlah" id="jumlah" oninput="quantitypump()" disabled>
                            <!-- <option value="0">-- Pilih Jumlah Pompa --</option>
                            <option value="1">1 Unit</option>
                            <option value="2" >2 Unit</option>
                            <option value="3">3 Unit</option> -->
                            <?php
                            // Static array option
                            $options = [
                                "0" => "-- Pilih Jumlah Pompa --",
                                "1" => "1 Unit",
                                "2" => "2 Unit",
                                "3" => "3 Unit"
                            ];
                            foreach ($options as $value => $label) {
                                if($value==$jml){ echo "<option value=\"$value\" selected>$label</option>";}
                                else{ echo "<option value=\"$value\">$label</option>";}
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group pb-2" id="rowpump1" style="<?php showSelectedField(1,$jml);?>">
                        <span class="input-group-text fw-bold" style="width: 155px;">Pompa 1</span>
                        <input class="form-control" type="text" name="pump1" id="pump1" value="<?php //$namaIdPumppit; ?>"  disabled>
                    </div>
                    <div class="input-group pb-2" id="rowpump2" style="<?php showSelectedField(2,$jml);?>">
                        <span class="input-group-text fw-bold" style="width: 155px;">Pompa 2</span>
                        <input class="form-control" type="text" name="pump2" id="pump2" value="<?php //$namaIdPumppit; ?>"  disabled>
                    </div>
                    <div class="input-group pb-2" id="rowpump3" style="<?php showSelectedField(3,$jml);?>">
                        <span class="input-group-text fw-bold" style="width: 155px;">Pompa 3</span>
                        <input class="form-control" type="text" name="pump3" id="pump3" value="<?php //$namaIdPumppit; ?>"  disabled>
                    </div>

                    <div class="fs-5 text-light fw-bolder">Dimensi Kolam Pump Pit</div>

                    <img src="dist/dimensikolam.png">
                    <div class="row" id="input_panjang_pumpit">
                        <div class="col-4"><label for="pKolam" class="col-form-label fst-italic fw-bold text-light">Panjang ( p )</label></div>
                        <div class="col-sm input-group input-group-sm pb-2">
                            <input type="number" class="form-control" name="pKolam" id="pKolam" value="<?= $pk; ?>" oninput="hitungVolume()" min="0" max="9999" step="0.1" disabled>
                            <span class="input-group-text"><b>Cm</b></span>
                        </div>
                    </div>
                    <div class="row" id="input_lebar_pumpit">
                        <div class="col-4"><label for="lKolam" class="col-form-label fst-italic fw-bold text-light">Lebar ( l )</label></div>
                        <div class="col-sm input-group input-group-sm pb-2">
                            <input type="number" class="form-control" name="lKolam" id="lKolam" value="<?= $lk; ?>" oninput="hitungVolume()" min="0" max="9999" step="0.1" disabled>
                            <span class="input-group-text"><b>Cm</b></span>
                        </div>
                    </div>
                    <div class="row" id="input_tinggi_pumpit">
                        <div class="col-4"><label for="tKolam" class="col-form-label fst-italic fw-bold text-light">Tinggi ( t )</label></div>
                        <div class="col-sm input-group input-group-sm pb-2">
                            <input type="number" class="form-control" name="tKolam" id="tKolam" value="<?= $tk; ?>" oninput="hitungVolume()" min="0" max="9999" step="0.1" disabled>
                            <span class="input-group-text"><b>Cm</b></span>
                        </div>
                    </div>
                    <div class="row" id="input_volume_pumpit">
                        <div class="col-4"><label for="vKolam" class="col-form-label fst-italic fw-bold text-light">Volume</label></div>
                        <div class="col-sm input-group input-group-sm pb-2">
                            <input type="text" class="form-control" id="vKolam" style="width:5rem;" readonly disabled>
                            <span class="input-group-text"><b>M<sup>3</sup></b></span>
                        </div>
                    </div>
                    <!-- Modal CONFIRM SIMPAN -->
                    <div class="modal fade" id="popupmodalconfirmsimpan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
                        <div class="modal-dialog modal-dialog-centered modal-m">
                            <div class="modal-content">
                                <div class="modal-body fw-semibold fs-5" id="">Apakah yakin akan menyimpan data?</div>
                                <div class="modal-footer ">
                                    <button type="button" class="btn btn-outline-dark align-middle" data-bs-dismiss="modal">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
                                        </svg>
                                    Tidak</button>
                                    <input type="hidden" name="idsimpan" id="idsimpan" >
                                    <button type="submit" name="yasimpan" id="yasimpan" class="btn btn-outline-danger">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
                                        <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
                                        </svg>
                                    Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal CONFIRM SIMPAN -->
                    </form>

                    <div class="row justify-content-end">
                        <div class="col-auto ">
                            <button type="button" name="submit" id="submit" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#popupmodalconfirmsimpan" onclick="$('#popupmodalconfirmsimpan #formdetailpumppit #yasimpan').attr({'name':'yasimpan'})" style="transition:all 1;display:none;" disabled>Simpan</button>
                            <!-- <input type="hidden" > -->
                        </div>
                    </div>
                    
                    
                </div>
            </td>
<!-- ########################### SECTION PUMP PIT / RUMAH POMPA -->
			<td style="width:1452px;">
                <div class="position-relative">
                    <div id="airLaut" style="position:absolute;left:0;bottom:0;width:317px;height:30px;overflow:hidden;background:linear-gradient(to top,#3160c5 0%,#00bfbfa4 100%);transition: all 3s ease;">
                        <!-- TINGGI PASUT AIRLAUT -->
                    </div>
                    <!-- SVG ARROW PASUT AIRLAUT -->
                    <div id="airLaut_arrow" class="fw-bold text-center z-3" style="position:absolute;left:116px;bottom:30px;width:140px;height:32px;color: #3f3f3f;text-shadow:0 0 5px #fff;transition: all 3s ease;">
                        <div id="airLaut_text" style="transition: all 3s linear;">Offline</div>
                        <svg style="z-index:-1; position:absolute; left:0px; top:-1px;" width="140" height="40" viewBox="0 0 140 40">
                            <polygon fill="#FF8200" points="0,0 140,0 140,25 70,33 0,25"></polygon>
                        </svg>
                    </div>

                    <!-- BOX AIR KOLAM / bgcolor biru -->
                    <div style="position:absolute;left:325px;bottom:111px;width:508px;height:264px;background-color:#00BFBF;">
                        <!-- TINGGI SENSOR AIR KOLAM -->
                        <div id="airKolam" style="transition: all 3s ease;background-color:#fff;width:508px;height:95%;"></div><!-- #ID-height%-upsidedown -->
                        <!-- SVG ARROW SENSOR AIR KOLAM -->
                        <div id="airKolam_arrow" class="fw-bold text-center z-3" style="position:absolute;left:353px;top:83%;width:140px;height:32px;color: #3f3f3f;text-shadow:0 0 5px #fff;transition: all 3s ease;"><!-- #ID-top%-upsidedown -->
                            <div id="airKolam_text" style="transition: all 3s linear;">Offline</div><!-- #ID-innerHtml -->
                            <svg style="z-index:-1; position:absolute; left:0px; top:-1px;" width="140" height="40" viewBox="0 0 140 40">
                                <polygon fill="#FF8200" points="0,0 140,0 140,25 70,33 0,25"></polygon>
                            </svg>
                        </div>
                    </div>

                    <img class="position-relative" src="dist/rumahpompa.png" style="left:67px;">
                    <img class="position-absolute" src="dist/pump_icon.png" style="left:498px;top:345px;visibility: hidden;" id="pumpfirst"><!-- ######## id DOM !! ######## -->
                    <img class="position-absolute" src="dist/pump_icon.png" style="left:594px;top:345px;visibility: hidden;" id="pumpsecond"><!-- ######## id DOM !! ######## -->
                    <img class="position-absolute" src="dist/pump_icon.png" style="left:699px;top:345px;visibility: hidden;" id="pumpthird"><!-- ######## id DOM !! ######## -->

                    <!-- *********************** ICON FUEL BAR GENSET -->
                    <div class="text-light fw-semibold" style="position: absolute;left:855px;top:234px;">
                        <div class="">
                            <svg width="30" height="49" fill="white" viewBox="0 0 16 16">
                                <path d="M1 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v8a2 2 0 0 1 2 2v.5a.5.5 0 0 0 1 0V8h-.5a.5.5 0 0 1-.5-.5V4.375a.5.5 0 0 1 .5-.5h1.495c-.011-.476-.053-.894-.201-1.222a.97.97 0 0 0-.394-.458c-.184-.11-.464-.195-.9-.195a.5.5 0 0 1 0-1q.846-.002 1.412.336c.383.228.634.551.794.907.295.655.294 1.465.294 2.081V7.5a.5.5 0 0 1-.5.5H15v4.5a1.5 1.5 0 0 1-3 0V12a1 1 0 0 0-1-1v4h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1zm2.5 0a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5v-5a.5.5 0 0 0-.5-.5z"/>
                            </svg>
                        </div>
                        <div class="">
                            <div class="fuel-container" id="fuelcontainer" style="box-shadow:0 0 11px#dc3545;">
                                <div class="fuel-bar" id="fuelbar" style="height:0%;background:#dc3545; transition:all 1s linear;"></div><!-- ######## id DOM !! ######## -->
                            </div>
                            <div class="fuel-label" id="fuellabel">0%</div><!-- ######## id DOM !! ######## -->
                        </div>
                    </div>

                    <!-- TEXT KVA GENSET & SWITCH -->
                    <div class="text-light fw-bold fs-5" style="position:absolute; left:969px; top:220px; width:81px; height:10px;">
                        <span>150 kVA</span>
                    </div>
                    <img class="position-absolute" src="dist/no_switch.png" style="left:1029px;top:274px;width:80px;" id="switchgenset"><!-- ######## id DOM !! ######## -->
                    <!-- TEXT KVA PLN & SWITCH -->
                    <div class="text-light fw-bold fs-5" style="position:absolute; left:1191px; top:220px; width:81px; height:10px;">
                        <span>250 kVA</span>
                    </div>
                    <img class="position-absolute" src="dist/no_switch.png" style="left:1242px;top:274px;width:80px;" id="switchpln"><!-- ######## id DOM !! ######## -->
                </div>
            </td>
		</tr>
<!-- ########################### SECTION PUMP PIT PARAMETER -->
		<tr>
			<td>
                <table class="table table-bordered border-info text-center" style="width:100%;height:300px;">
					<thead ><tr><th class="p-3 fs-4 text-light" colspan="3" style="background: #01afffcc;">PUMP PIT PARAMETER</th></tr></thead>
					<thead class="table-group-divider text-center" >
					  <tr>
						<th id="parameterhead1" style="background: #01afffcc;color:#fff;">Pompa 1</th>
						<th id="parameterhead2" style="background: #01afffcc;color:#fff;">Pompa 2</th>
						<th id="parameterhead3" style="background: #01afffcc;color:#fff;">Pompa 3</th>
					  </tr>
					</thead>
					<tbody class="font-monospace">
						<tr>
							<td>
                                <!-- TABEL POMPA ke 1 -->
								<table class="table table-bordered">
                                    <tr>
                                        <th>Pump Status</th><th>Apparent Power</th><th>Run Hours M1</th>
                                    </tr>
                                    <tr>
                                        <td><div id="P1param1">Offline</div></td><td><div id="P1param2">0 kVA</div></td><td><div id="P1param3">0 Hours</div></td>
                                    </tr>
                                    <tr>
                                        <th>Voltage L1-N</th><th>Voltage L2-N</th><th>Voltage L3-N</th>
                                    </tr>
                                    <tr>
                                        <td><div id="P1param4">0 V</div></td><td><div id="P1param5">0 V</div></td><td><div id="P1param6">0 V</div></td>
                                    </tr>
								</table>
							</td>
							<td>
                                <!-- TABEL POMPA ke 2 -->
								<table class="table table-bordered">
                                    <tr>
                                        <th>Pump Status</th><th>Apparent Power</th><th>Run Hours M2</th>
                                    </tr>
                                    <tr>
                                        <td><div id="P2param1">Offline</div></td><td><div id="P2param2">0 kVA</div></td><td><div id="P2param3">0 Hours</div></td>
                                    </tr>
                                    <tr>
                                        <th>Voltage L1-N</th><th>Voltage L2-N</th><th>Voltage L3-N</th>
                                    </tr>
                                    <tr>
                                        <td><div id="P2param4">0 V</div></td><td><div id="P2param5">0 V</div></td><td><div id="P2param6">0 V</div></td>
                                    </tr>
								</table>
							</td>
							<td>
                                <!-- TABEL POMPA ke 3 -->
								<table class="table table-bordered">
								    <tr>
                                        <th>Pump Status</th><th>Apparent Power</th><th>Run Hours M3</th>
								    </tr>
                                    <tr>
                                        <td><div id="P3param1">Offline</div></td><td><div id="P3param2">0 kVA</div></td><td><div id="P3param3">0 Hours</div></td>
                                    </tr>
                                    <tr>
                                        <th>Voltage L1-N</th><th>Voltage L2-N</th><th>Voltage L3-N</th>
                                    </tr>
                                    <tr>
                                        <td><div id="P3param4">0 V</div></td><td><div id="P3param5">0 V</div></td><td><div id="P3param6">0 V</div></td>
                                    </tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
            </td>
		</tr>
	</table>
    </div>
	    
        <!-- Modal NOTIFICATION -->
		<div class="modal fade" id="popupmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body fw-semibold fs-5" id="popupcontent"><!-- Modal content text --></div>
					<div class="modal-footer align-middle "><form method="GET" target="_SELF">
						<button type="submit" class="btn btn-outline-info" data-bs-dismiss="modal" name="p" value="<?= $getUri; ?>">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
							<path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
							<path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
							</svg>
						OK</button></form>
					</div>
				</div>
			</div>
		</div>
        <!-- End of Modal NOTIFICATION -->
    <script>
    let varApi;let varApi2;let varApi3;let strApi
    function popupmodal(textcontent){
        new bootstrap.Modal(document.getElementById('popupmodal')).show()
        document.getElementById('popupcontent').innerHTML=textcontent
    }

    // SHOW FORM INPUT POMPA
	function quantitypump(v){
        let x;let yy=document.getElementById('jumlah').value;
        let p1=document.getElementById('rowpump1');let pk1=document.getElementById('pumpfirst')
        let p2=document.getElementById('rowpump2');let pk2=document.getElementById('pumpsecond')
        let p3=document.getElementById('rowpump3');let pk3=document.getElementById('pumpthird')
        if(v==undefined ){x=document.getElementById('jumlah').value}
        else{x=v}
        document.getElementById("jumlah").options.selectedIndex=x
        if(x==1){
            p1.style.display='';pk1.style.visibility='visible'
            p2.style.display='none';pk2.style.visibility='hidden'
            p3.style.display='none';pk3.style.visibility='hidden'
        }
        else if(x==2){
            p1.style.display='';pk1.style.visibility='visible'
            p2.style.display='';pk2.style.visibility='visible'
            p3.style.display='none';pk3.style.visibility='hidden'
        }
        else if(x==3){
            p1.style.display='';pk1.style.visibility='visible'
            p2.style.display='';pk2.style.visibility='visible'
            p3.style.display='';pk3.style.visibility='visible'
        }
        else{
            p1.style.display='none';pk1.style.visibility='hidden'
            p2.style.display='none';pk2.style.visibility='hidden'
            p3.style.display='none';pk3.style.visibility='hidden'
        }
        
    }

    // ENABLED EDIT FORM PUMP PIT
    function editPumppit(){
        let stat
        if(document.getElementById('lokasi').disabled==true){stat=false;dsply=""}
        else{stat=true;dsply="none"}
        function domid(z){
            document.getElementById(z).disabled=stat
        }
        document.getElementById('submit').style.display=dsply
        domid('lokasi');domid('zona');domid('ipaddress');domid('jumlah');domid('submit');
        domid('pump1');domid('pump2');domid('pump3');domid('pKolam');domid('lKolam');domid('tKolam');
    }

    // CALCULATE VOLUME KOLAM
    function hitungVolume(){
        let pDom=parseFloat(document.getElementById('pKolam').value)
        let lDom=parseFloat(document.getElementById('lKolam').value)
        let tDom=parseFloat(document.getElementById('tKolam').value)
        if (isNaN(pDom) || isNaN(lDom) || isNaN(tDom)) {
            document.getElementById('vKolam').value="0";
            return;
        }
        let v="0"
        v=(pDom*lDom*tDom)/1000000
        document.getElementById('vKolam').value=v
    }
    
    //FETCHING API DATA
    async function dataApi(url){
        const apiSensor = await fetch(url)
        return await apiSensor.json()
    } let atNow = Math.floor(Date.now()/1000)

    // PASUT tanjungemas
    function pasutairlaut() {
        const fetchData = async () => {
            try {
            const respon = await dataApi('https://www.tanjungemas.com/api/pasut_restapi.php')
            let uSonic=respon.realtime_data.ultrasonic
            let stat=respon.realtime_data.status
            let mlws=(uSonic/2)*381  // 2 mlws max // 322px max height lower lining seawater's // 381px max height higher lining seawater's 
            let tx;let px;
            if(stat!="OFFLINE"){
                if(uSonic>=2){px="322px"}
                else if(uSonic<0){px="0px"}
                else{px=mlws+"px";}
                tx=uSonic+" MLWS";
            }
            else{tx="Offline";px="1px";}
            document.getElementById('airLaut').style.height=px
            document.getElementById('airLaut_text').innerText=tx
            document.getElementById('airLaut_arrow').style.bottom=px
            }
            catch (error) {   //jika gagal mendapakan API JSON
            // console.error('Failed to fetch data:', error);
            }
        }
        //get first data
        fetchData()
        const intervalId = setInterval(fetchData, 10000)
        return () => clearInterval(intervalId)
    }

    // STATUS ON-OFF POMPA
    function pumpStatus(uri,interval,idpump1,idpump2,idpump3){
        const fetchData = async () => {
            try {
                const dat = await dataApi(uri)
                let statPum1=dat.data.statusPump1
                let statPum2=dat.data.statusPump2
                let statPum3=dat.data.statusPump3
                let apiTime=dat.data.request
                let reduce30=atNow-30
                if(typeof idpump1!=='undefined' || idpump1!==null){
                    if (apiTime>=reduce30) {document.getElementById(idpump1).innerHTML=statPum1} else{document.getElementById(idpump1).innerHTML="Offline"}
                }
                if(typeof idpump2!=='undefined' || idpump1!==null){
                    if (apiTime>=reduce30) {document.getElementById(idpump2).innerHTML=statPum2} else{document.getElementById(idpump2).innerHTML="Offline"}
                }
                if(typeof idpump3!=='undefined' || idpump1!==null){
                    if (apiTime>=reduce30) {document.getElementById(idpump3).innerHTML=statPum3} else{document.getElementById(idpump3).innerHTML="Offline"}
                }
                
                // if (apiTime>=reduce30) {
                //     document.getElementById(idpump1).innerHTML=statPum1
                //     document.getElementById(idpump2).innerHTML=statPum2
                //     document.getElementById(idpump3).innerHTML=statPum3
                // }
                // else{
                //     document.getElementById(idpump1).innerHTML="Offline"
                //     document.getElementById(idpump2).innerHTML="Offline"
                //     document.getElementById(idpump3).innerHTML="Offline"
                // }
            }
            catch (error) {   //jika gagal mendapakan API JSON
                // console.error('Failed to fetch data:', error);
            }
        }
        //get first data
        fetchData()
        const intervalId = setInterval(fetchData, interval)
        return () => clearInterval(intervalId)
    }

    //FUNGSI PARAMETER POMPA
    function pumpParameter(uri,interval,idpln,idwater,idkva,idvL1N,idvL2N,idvL3N,idrunM1,idrunM2,idrunM3) {
        const fetchData = async () => {
            try {
            const dat = await dataApi(uri)
            let usonic=dat.data.ultrasonic;let apparpower=dat.data.apparentPower
            let vL1N=dat.data.voltageL1_N;let vL2N=dat.data.voltageL2_N;let vL3N=dat.data.voltageL3_N;
            let runM1=dat.data.runhourM1;let runM2=dat.data.runhourM2;let runM3=dat.data.runhourM3;
            let apiTime=dat.data.request
            let waterText=idwater+"_text";let waterArrow=idwater+"_arrow"
            // let now=Math.floor(new Date().getTime()/1000)
            let reduce30=atNow-30
            let valTKolam=document.getElementById('tKolam').value
            if(valTKolam==NaN || valTKolam==0 || valTKolam==null || valTKolam==""){valTKolam=300} //default tinggi kolam 300cm
            let valWatr=(usonic/valTKolam)*100 // 264px = 100% max height poolwater // 111px lowest bottom
            if(valWatr>=100){valWatr=100}   //overflow above 100%
            let valWatrArrw=valWatr-12
            // if(waterTop>=263){waterTop=263}
            if (apiTime>=reduce30){
                let p2kva=idkva.replace('P1','P2')
                let p3kva=idkva.replace('P1','P3')
                if(dat.data.statusPump1=="ON"){document.getElementById(idkva).innerHTML=apparpower+" kVA"}
                else{document.getElementById(idkva).innerHTML="0 kVA"}
                if(dat.data.statusPump2=="ON"){document.getElementById(p2kva).innerHTML=apparpower+" kVA"}
                else{document.getElementById(p2kva).innerHTML="0 kVA"}
                if(dat.data.statusPump3=="ON"){document.getElementById(p3kva).innerHTML=apparpower+" kVA"}
                else{document.getElementById(p3kva).innerHTML="0 kVA"}

                document.getElementById(idpln).src='dist/nc_switch.png'
                document.getElementById(idwater).style.height=valWatr.toString()+"%"
                document.getElementById(waterArrow).style.top=valWatrArrw.toString()+"%"
                document.getElementById(waterText).innerHTML=usonic.toString()+" cm"
                
                document.getElementById(idvL1N).innerHTML=vL1N+" V"
                document.getElementById(idvL2N).innerHTML=vL2N+" V"
                document.getElementById(idvL3N).innerHTML=vL3N+" V"
                document.getElementById(idrunM1).innerHTML=runM1+" Hrs"
                document.getElementById(idrunM2).innerHTML=runM2+" Hrs"
                document.getElementById(idrunM3).innerHTML=runM3+" Hrs"
                let p2L1=idvL1N.replace('P1','P2');let p2L2=idvL2N.replace('P1','P2');let p2L3=idvL3N.replace('P1','P2')
                let p3L1=idvL1N.replace('P1','P3');let p3L2=idvL2N.replace('P1','P3');let p3L3=idvL3N.replace('P1','P3')
                document.getElementById(p2L1).innerHTML=vL1N+" V";document.getElementById(p2L2).innerHTML=vL2N+" V";document.getElementById(p2L3).innerHTML=vL3N+" V"
                document.getElementById(p3L1).innerHTML=vL1N+" V";document.getElementById(p3L2).innerHTML=vL2N+" V";document.getElementById(p3L3).innerHTML=vL3N+" V"
                }
                else{
                    document.getElementById(idwater).style.height="0px"
                    document.getElementById(waterText).innerHTML="0cm"
                    // document.getElementById(idwater).style.background=bgColor
                }
            }
            catch (error) {   //jika gagal mendapakan API JSON
                // console.error('Failed to fetch data:', error);
            }
        }
        //get first data
        fetchData()
        const intervalId = setInterval(fetchData, interval)
        return () => clearInterval(intervalId)
    }

    // ?????
    function fuel(){
        let h;let bg;let bs;let fuel=0;
        h=fuel+"%"
        if(fuel>50){//50-100 bg success//"#198754"
            bg="#3C3";
            bs="0 0 11px #000";
        }
        else if(fuel>25 && fuel<=50){//25-50 bg warning
            bg="#ffc107";bs="0 0 11px #000";
        }
        else{//0-25 bg danger
            bg="#dc3545";bs="0 0 11px #dc3545";
        }
        document.getElementById('fuelbar').style.height=h
        document.getElementById('fuelbar').style.background=bg
        document.getElementById('fuellabel').innerText=h
        document.getElementById('fuelcontainer').style.boxShadow=bs
    }

    varApi='<?= json_encode($vApi); ?>' // ambil data variable php
    varApi=varApi.replace(/["]/g,'')   // Hapus tanda " "
    pumpStatus(varApi,5000,'P1param1','P2param1','P3param1')

    varApi2='<?php if(isset($vApi2)){echo json_encode($vApi2);} ?>'
    varApi2=varApi2.replace(/["]/g,'')
    if(varApi2!=''){
        pumpStatus(varApi2,5000,'P3param1')
    }
    varApi3='<?php if(isset($vApi3)){echo json_encode($vApi3);} ?>'
    varApi3=varApi3.replace(/["]/g,'')
    if(varApi3!=''){
        pumpStatus(varApi3,5000,'P2param1')
    }
    
    pumpParameter(varApi,5000,'switchpln','airKolam','P1param2','P1param4','P1param5','P1param6','P1param3','P2param3','P3param3')
    pasutairlaut()
    hitungVolume()
    quantitypump()
    fuel()
    </script>
</body>
</html>
<?php
/* SIMPAN UPDATE DATA ----------------- */
if(isset($_POST['yasimpan'])){
    $lokasiPumppit=$_POST['lokasi'];$zonaPumppit=$_POST['zona'];
    $jumlahPump=$_POST['jumlah'];$ip=$_POST['ipaddress'];
    $panjangKolam=$_POST['pKolam'];
    $lebarKolam=$_POST['lKolam'];
    $tinggiKolam=$_POST['tKolam'];
    $nam=$_POST['namaid'];
    if($panjangKolam=="" && $lebarKolam=="" && $tinggiKolam==""){$panjangKolam=$lebarKolam=$tinggiKolam=0;}

    $sqltampil = "SELECT * FROM TB_RUMAH_PUMPPIT WHERE NAMA_PUMPPIT='$nam'";
    $data=oci_parse($conn,$sqltampil);
    oci_execute($data);
    $row=oci_fetch_assoc($data);
    if($row){
        $sqlsimpan = "UPDATE TB_RUMAH_PUMPPIT SET LOKASI_PUMPPIT= :lok, ZONA_PUMPPIT= :zona, PANJANG_KOLAM= :pnj, LEBAR_KOLAM= :lbr, TINGGI_KOLAM= :tgi, JUMLAH_POMPA= :jml, IPADDRESS= :ip WHERE NAMA_PUMPPIT= :nam";
        $parse=oci_parse($conn,$sqlsimpan);

        oci_bind_by_name($parse, ':lok', $lokasiPumppit);
        oci_bind_by_name($parse, ':zona', $zonaPumppit);
        oci_bind_by_name($parse, ':pnj', $panjangKolam);
        oci_bind_by_name($parse, ':lbr', $lebarKolam);
        oci_bind_by_name($parse, ':tgi', $tinggiKolam);
        oci_bind_by_name($parse, ':jml', $jumlahPump);
        oci_bind_by_name($parse, ':ip', $ip);
        oci_bind_by_name($parse, ':nam', $nam);
        
        if(oci_execute($parse))
        {
            oci_commit($conn);
            ?><script>popupmodal("Data telah berhasil diupdate")</script><?php
        }
        else{ ?><script>popupmodal("Data gagal diupdate !")</script><?php }
    }
    else{ ?><script>popupmodal("Tidak ada data ID tersebut di database !")</script><?php }
    oci_free_statement($parse);
    oci_free_statement($data);
}
/* END of SIMPAN UPDATE DATA ----------------- */

oci_close($conn);
?>