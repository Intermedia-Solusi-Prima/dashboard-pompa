<?php
require_once("auth.php");
require_once("orc_conn.php");
auth_user_level("admin",$_SESSION['role']);

function zero($valu){
    if($valu>=0){
        $nol=number_format($valu,3,".","");
        $plusnol="+".$nol;
        $valu=$plusnol;
        echo $valu;
    }
    else{
        $nol=number_format($valu,3,".","");
        $valu=$nol;
        echo $valu;
    }
}
/* TAMPIL DATA ----------------- */
$oraquery="SELECT BAHAYA_TERTINGGI,WASPADA_TERTINGGI,AMAN_TERTINGGI,AMAN_TERENDAH,USERNAME,TO_CHAR(TANGGAL, 'DD-MM-YYYY HH24:MI') AS TANGGAL FROM LEVELMLWS WHERE ID=1";

$ambildata=oci_parse($conn,$oraquery);
oci_execute($ambildata);
$row = oci_fetch_array($ambildata);
$tanggal=$row['TANGGAL'];
$user=$row['USERNAME'];

$rowbahaya=$row['BAHAYA_TERTINGGI'];
$viewBahaya=number_format($rowbahaya ,1,".","");

$rowwaspada=$row['WASPADA_TERTINGGI'];
$viewWaspada=number_format($rowwaspada ,1,".","");

$rowaman=$row['AMAN_TERTINGGI'];
$viewAman=number_format($rowaman ,1,".","");

$rowamanlow=$row['AMAN_TERENDAH'];
$viewAmanLow=number_format($rowamanlow ,1,".","");
oci_free_statement($ambildata);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONITORING PASANG SURUT PELABUHAN TANJUNG EMAS SEMARANG</title>
    <link rel="icon" type="image/x-icon" href="dist/favicon.png">
    <link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
    <script src="dist/jquery/jquery-3.7.1.min.js"></script>
    <script src="dist/bootstrap/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
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
	<nav class="navbar navbar-expand-xl" style="background:#4c4c4c;">
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
                        <li class="nav-item dropdown text-center" style="cursor:pointer"><!-- DETAIL PUMP PIT MENU -->
                            <a class="nav-link dropdown-toggle fs-6" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg viewBox="0 0 16 16" width="30" fill="#ddd">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg></a>
                            <div style="line-height:1">DETAIL<br>PUMP PIT</div>
                            <ul class="dropdown-menu">
                                <?php
                                // FETCH DATA NAMA PUMPPIT DI NAVBAR MENU
                                $querynama = "SELECT NAMA_PUMPPIT FROM TB_RUMAH_PUMPPIT";
                                $dtnama=oci_parse($conn,$querynama);
                                oci_execute($dtnama);$n=1;
                                while($row=oci_fetch_assoc($dtnama)){
                                    $output=$row['NAMA_PUMPPIT'];
                                    $lowname=strtolower($output);
                                    $uppername=ucfirst($lowname);
                                    echo "<li><a class='dropdown-item' href='detail_pump.php?p=".$lowname."'>".$uppername."</a></li>";
                                    $n++;
                                }
                                oci_free_statement($dtnama);
                                ?>
                            </ul>
                        </li>
                    <div class="ms-3 me-3 vr"></div>
                        <li class="nav-item dropdown"><!-- POMPA MENU -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="dist/x_pompa.png"></a>
							<ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="daftarpompa.php">Daftar Pompa</a></li>
                                <li><a class="dropdown-item" href="daftarpumppit.php">Daftar Pump Pit</a></li>
                            </ul>
                        </li>
                    <div class="ms-3 me-3 vr"></div>
                        <li class="nav-item dropdown"><!-- REPORT MENU -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="dist/x_report.png"></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="reportpompa.php">Report Pompa</a></li>
                                <li><a class="dropdown-item" href="maintenance.php">Maintenance List</a></li>
                            </ul>
                        </li>
                    <div class="ms-3 me-3 vr"></div>
                        <li class="nav-item dropdown"><!-- PASUT MENU -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="dist/chart-white-100.png" width="50" height="50"></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="monitoringpasut.php">Grafik Pasang Surut</a></li>
                                <li><a class="dropdown-item" href="levelmlws.php">Batas Level Pasang Surut</a></li>
                            </ul>
                        </li>
                    <div class="ms-3 me-3 vr"></div>
                        <li class="nav-item text-center text-capitalize" style="line-height:1;cursor:pointer"><!-- USER MENU -->
                            <a class="nav-link" href="#"><img src="dist/x_user.png"></a>
                            <?php if(isset($_SESSION['loginauth'])) echo "<b>".$_SESSION['nama']."</b><br>(".$_SESSION['role'].")";?>
                        </li>
                    <div class="ms-3 me-3 vr"></div>
                        <li class="nav-item" style="line-height:1;cursor:pointer"><!-- LOGOUT MENU -->
                            <a class="nav-link" href="logout.php"><img src="dist/x_logout.png"></a>Logout
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

    <div class="container-fluid">
        <div class="card">
          <div class="card-header p-3 fs-4 fw-bold text-center">BATAS LEVEL PASANG SURUT AIR LAUT<br>PELABUHAN TANJUNG EMAS SEMARANG</div>
            
            <!--LEVEL MLWS PASUT SECTION START-->
            <div class="card-body p-0 ">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <table class="text-end ">
                            <tr>
                                <td><span class="badge rounded-pill text-bg-danger fs-5 ">Batas Bahaya Tertinggi</span><span class="badge text-bg-danger fs-5 "><?php echo zero($viewBahaya)."<br>MLWS"; ?></span></td>
                                <td rowspan="4"><img src="dist/svg/lowtide.svg" height="400vmin" /></td>
                            </tr>
                            <tr>
                                <td><span class="badge rounded-pill text-bg-warning fs-5 ">Batas Waspada Tertinggi</span><span class="badge text-bg-warning fs-5 "><?php echo zero($viewWaspada)."<br>MLWS"; ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="badge rounded-pill text-bg-success fs-5 ">Batas Aman Tertinggi</span><span class="badge text-bg-success fs-5 "><?php echo zero($viewAman)."<br>MLWS"; ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="badge rounded-pill text-bg-secondary fs-5 ">Batas Aman Terendah</span><span class="badge text-bg-secondary fs-5 "><?php echo zero($viewAmanLow)."<br>MLWS"; ?></span></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="badge rounded-pill text-bg-light fs-5 fst-italic">Update Terakhir Pada Tanggal : <?php echo "<b>".$tanggal."</b> oleh <b>".$user.".</b>"; ?></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto"><button type="button" class="btn btn-outline-info m-2" data-bs-toggle="modal" data-bs-target="#editlevel"><b>Update Batas Level</b></button></div>
                </div>
            </div>
            <!--LEVEL MLWS PASUT SECTION END-->
        </div>

    <!-- Modal fullscreen *******************************************************************************************-->
        <div class="modal fade" id="editlevel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
              <div class="modal-body text-center">
                  <form class="form-control-lg" action="" target="_SELF" method="POST" autocomplete="on">
                    <div class="form-floating mt-2">
                        <!--  -->
                        <input type="number" step="0.01" min="-5.0" max="5.0" class="form-control" id="floatingbahaya" name="bahaya" placeholder="Batas Bahaya Tertinggi" value="<?php echo $viewBahaya; ?>" required>
                        <label for="floatingbahaya">Batas Bahaya Tertinggi (MLWS)</label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="number" step="0.01" min="-5.0" max="5.0" class="form-control" id="floatingwaspada" name="waspada" placeholder="Batas Waspada Tertinggi" value="<?php echo $viewWaspada; ?>" required>
                        <label for="floatingwaspada">Batas Waspada Tertinggi (MLWS)</label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="number" step="0.01" min="-5.0" max="5.0" class="form-control" id="floatingaman" name="aman" placeholder="Batas Aman Tertinggi" value="<?php echo $viewAman; ?>" required>
                        <label for="floatingaman">Batas Aman Tertinggi (MLWS)</label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="number" step="0.01" min="-5.0" max="5.0" class="form-control" id="floatingamanlow" name="amanlow" placeholder="Batas Aman Terendah" value="<?php echo $viewAmanLow; ?>" required>
                        <label for="floatingamanlow">Batas Aman Terendah (MLWS)</label>
                    </div>
                    <input class="btn btn-outline-success mt-2" type="submit" value="Update Data" name="update">
                    <button class="btn btn-outline-danger mt-2" data-bs-dismiss="modal">Cancel</button>
                    
                </form>
                
              </div>
            </div>
          </div>
        </div>
    <!--End of Modal fullscreen *******************************************************************************************-->
    
        <!-- Modal NOTIFICATION -->
        <div class="modal fade" id="popupmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body fw-semibold fs-5" id="popupcontent"><!-- Modal content text --></div>
                    <div class="modal-footer align-middle ">
                        <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal" onclick="redirect()">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
                            <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
                            </svg>
                        OK</button>
                    </div>
                </div>
            </div>
        </div><!-- End of Modal NOTIFICATION -->
        <!-- Modal CONFIRM SURE -->
        <div class="modal fade" id="popupmodalconfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body fw-semibold fs-5" id="contentconfirm"><!-- Modal content text --></div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-outline-dark align-middle" data-bs-dismiss="modal">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
                                <path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
                            </svg>
                        Tidak</button>
                        <form method="post" target="_self" id="" action="">
                        <input type="hidden" name="" id="" value="">
                        <button type="submit" name="" id="" class="btn btn-outline-danger">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
                                <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"/>
                            </svg>
                        Yakin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- End of Modal CONFIRM SURE -->
    </div>

    <script>
        function popupmodal(textcontent){
            new bootstrap.Modal(document.getElementById('popupmodal')).show()
            document.getElementById('popupcontent').innerHTML=textcontent
        }
        function popupmodalconfirm(textcontent){
            new bootstrap.Modal(document.getElementById('popupmodalconfirm')).show()
            document.getElementById('contentconfirm').innerHTML=textcontent
        }
        function redirect(){
            document.location='levelmlws.php';
        }
    </script>
<?php
/* UPDATE DATA ----------------- */


if(isset($_POST['update'])){
    $updateBahaya=$_POST['bahaya'];
    $updateWaspada=$_POST['waspada'];
    $updateAman=$_POST['aman'];
    $updateAmanlow=$_POST['amanlow'];
    $user=$_SESSION['nama'];

    if($updateAmanlow<$updateAman && $updateAman<$updateWaspada && $updateWaspada<$updateBahaya){
        $sqlupdate="UPDATE LEVELMLWS SET AMAN_TERENDAH=:amanlow, AMAN_TERTINGGI=:aman, WASPADA_TERTINGGI=:waspada, BAHAYA_TERTINGGI=:bahaya, USERNAME=:user, TANGGAL=SYSTIMESTAMP WHERE id=1";
        $updatedata=oci_parse($conn,$sqlupdate);
        oci_bind_by_name($updatedata, ':bahaya', $updateBahaya);
        oci_bind_by_name($updatedata, ':waspada', $updateWaspada);
        oci_bind_by_name($updatedata, ':aman', $updateAman);
        oci_bind_by_name($updatedata, ':amanlow', $updateAmanlow);
        oci_bind_by_name($updatedata, ':user', $user);

        if (oci_execute($updatedata)) {
            oci_commit($conn);
          ?><script>popupmodal("DATA TELAH BERHASIL DIUPDATE"); </script><?php
           header('Refresh: 0');
        } else {
          ?><script>popupmodal("DATA GAGAL DIUPDATE");</script><?php
        }
    }
    else{
        ?><script>popupmodal("DATA GAGAL DIUPDATE !!\nKARENA BATAS NILAI LEBIH KECIL ATAU LEBIH BESAR DARI NILAI YANG LAIN");</script><?php
    }
    oci_free_statement($updatedata);
}

?>
</body>
</html>
<?php
oci_close($conn);
?>