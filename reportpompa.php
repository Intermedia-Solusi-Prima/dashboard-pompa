<?php
require_once("auth.php");
require_once("orc_conn.php");
auth_user_level("teknik",$_SESSION['role'])
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTIVITY REPORT POMPA BANJIR PELABUHAN TANJUNG EMAS SEMARANG</title>
    <link rel="icon" type="image/x-icon" href="dist/favicon.png">
    <link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dist/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="dist/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="dist/datatable/buttons.bootstrap4.min.css">

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
                        <li class="nav-item"><!-- POMPA MENU -->
                            <a class="nav-link" href="daftarpompa.php"><img src="dist/x_pompa.png"></a>
                        </li>
                    <div class="ms-3 me-3 vr"></div>
                        <li class="nav-item dropdown"><!-- REPORT MENU -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="dist/x_report.png"></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="reportpompa.php">Report Pompa</a></li>
                                <li><a class="dropdown-item" href="#">Report Pumppit</a></li>
                                <li><a class="dropdown-item" href="#">Report Pasut</a></li>
                            </ul>
                        </li>
                    <div class="ms-3 me-3 vr"></div>
                        <li class="nav-item text-center text-capitalize" style="line-height:1;cursor:pointer"><!-- USER MENU -->
                            <a class="nav-link" href="#"><img src="dist/x_user.png"></a>
                            <?php if(isset($_SESSION['loginauth'])) echo "<b>".$_SESSION['username']."</b><br>(".$_SESSION['role'].")";?>
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
          <div class="card-header p-3 fs-4 fw-bold text-center">ACTIVITY REPORT POMPA BANJIR<br>PELABUHAN TANJUNG EMAS SEMARANG</div>
          <!-- <div class=""> -->
            <form class="row row-cols-sm-auto g-3 mt-1 align-items-center justify-content-center" action="" target="_SELF" method="POST" autocomplete="on">
                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-text fw-semibold">Start Date</span>
                        <input type="date" class="form-control" placeholder="date" id="date1" name="date1" value="<?php if(isset($_POST['date1'])){echo $_POST['date1'];}?>">
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-text fw-semibold">End Date</span>
                        <input type="date" class="form-control" placeholder="date" id="date2" name="date2" value="<?php if(isset($_POST['date2'])){echo $_POST['date2'];}?>">
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group">
                        <input type="submit" class="btn btn-outline-primary fw-semibold" value="Cari" id="submitcari" name="submitcari">
                    </div>
                </div>
            </form>
          <!-- </div> -->
          <div class="card-body">
            <table id="reports1" class="table table-bordered table-hover">
              <thead>
                <tr class="table-info align-middle">
                  <th>#</th>
                  <th>Lokasi Pompa</th>
                  <th>Nama Pompa</th>
                  <th>Mode</th>
                  <th>Status ON Pump1</th>
                  <th>Status ON Pump2</th>
                  <th>Status ON Pump3</th>
                  <th>RunHour Pump1</th>
                  <th>RunHour Pump2</th>
                  <th>RunHour Pump3</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
<?php
function HoursMinutes($val) {
    $flot=floatval($val);
    $jam=floor($flot);
    $menit=($flot - $jam) * 60;
    $menit=round($menit);
    return "{$jam} <sub>jam,</sub> {$menit} <sub>menit</sub>";
}

if(isset($_POST['submitcari'])){
    $date1=$_POST['date1']." 00:00:00";
    $date2=$_POST['date2']." 23:59:59";
$no=1;
$sqlq="SELECT 'AMPENAN' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_AMPENAN WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'BEST' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_BEST WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CLUSTER 2' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CLUSTER2 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CLUSTER 2' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CLUSTER2_2 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CLUSTER 2' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CLUSTER2_3 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CLUSTER 3' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CLUSTER3 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CLUSTER 3' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CLUSTER3_2 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CLUSTER 3' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CLUSTER3_3 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CY 1' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CY1 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CY 1' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CY1_2 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CY 1' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CY1_3 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CY 2' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CY2 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'CY 4' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_CY4 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'DELI' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_DELI WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'KANTOR' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_KANTOR WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'KBB 1' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_KBB1 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'KBB 2' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_KBB2 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'KBB 3' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_KBB3 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'KEPANDUAN' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_KEPANDUAN WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'PRASASTI' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_PRASASTI WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'PRASASTI' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_PRASASTI2 WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))
    UNION ALL
    SELECT 'RTK' AS LOKASI,MOTORNAME,CONTROLLER_MODE,COUNT(CASE WHEN PUMP1_STATUS = 'ON' THEN 1 END) AS ONP1,COUNT(CASE WHEN PUMP2_STATUS = 'ON' THEN 1 END) AS ONP2,COUNT(CASE WHEN PUMP3_STATUS = 'ON' THEN 1 END) AS ONP3,
    MAX(RUNHOURM1)-MIN(RUNHOURM1) AS HOURM1,MAX(RUNHOURM2) - MIN(RUNHOURM2) AS HOURM2,MAX(RUNHOURM3) - MIN(RUNHOURM3) AS HOURM3,TRUNC(DATETIME) AS DATEONLY 
    FROM POMPA_RTKTIMUR WHERE DATETIME BETWEEN TO_TIMESTAMP('$date1','YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$date2','YYYY-MM-DD HH24:MI:SS') GROUP BY MOTORNAME,CONTROLLER_MODE,(TRUNC(DATETIME))";
    $data=oci_parse($conn,$sqlq);
    oci_execute($data);
	while(($row=oci_fetch_array($data))==true){
        $rowlokasi=$row['LOKASI'];
        $rownama=$row['MOTORNAME'];
        $rowmode=$row['CONTROLLER_MODE'];
        $stat1=$row['ONP1'];
            $rowstat1="{$stat1}<sub> kali</sub>";
        $stat2=$row['ONP2'];
            $rowstat2="{$stat2}<sub> kali</sub>";
        $stat3=$row['ONP3'];
            $rowstat3="{$stat3}<sub> kali</sub>";
        $hour1=$row['HOURM1'];
		    $rowhour1=number_format($hour1 ,1,".","");
        $hour2=$row['HOURM2'];
		    $rowhour2=number_format($hour2 ,1,".","");
        $hour3=$row['HOURM3'];
		    $rowhour3=number_format($hour3 ,1,".","");
        $rowtime=$row['DATEONLY'];
?>
                <tr>
                    <th ><?= $no; ?></th>
                    <td><?= $rowlokasi;?></td>
                    <td><?= $rownama;?></td>
                    <td><?= $rowmode;?></td>
                    <td><?= $rowstat1;?></td>
                    <td><?= $rowstat2;?></td>
                    <td><?= $rowstat3;?></td>
                    <td><?= HoursMinutes($rowhour1);?></td>
                    <td><?= HoursMinutes($rowhour2);?></td>
                    <td><?= HoursMinutes($rowhour3);?></td>
                    <td><?= $rowtime;?></td>
                </tr>
<?php
        $no++;
    }// END of While Looping
    oci_free_statement($data);
}
?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    <script src="dist/jquery/jquery-3.7.1.min.js"></script>
    <script src="dist/bootstrap/bootstrap.bundle.min.js"></script>

    <script src="dist/datatable/jquery.dataTables.min.js"></script>
    <script src="dist/datatable/dataTables.min.js"></script>
    <script src="dist/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="dist/datatable/dataTables.responsive.min.js"></script>
    <script src="dist/datatable/dataTables.buttons.min.js"></script>
    <script src="dist/datatable/responsive.bootstrap4.min.js"></script>
    <script src="dist/datatable/buttons.bootstrap4.min.js"></script>
    <script src="dist/datatable/buttons.colVis.min.js"></script>
    <script src="dist/datatable/buttons.html5.min.js"></script>
    <script src="dist/datatable/jszip.min.js"></script>
    <script src="dist/datatable/pdfmake.min.js"></script>
    <script src="dist/datatable/vfs_fonts.js"></script>

    <!-- Page specific script -->
    <script>
    $(function () {
      $("#reports1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["csv", "excel", "pdf", "colvis"]
      }).buttons().container().appendTo('#reports1_wrapper .col-md-6:eq(0)');
    });
    </script>
</body>
</html>
<?php
oci_close($conn);
?>