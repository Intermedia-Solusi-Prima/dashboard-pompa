<?php
require_once("auth.php");
require_once("orc_conn.php");

function jumlahPompa($conn,$namapumppit){
  $sqljmlpompa = "SELECT NAMA_PUMPPIT,JUMLAH_POMPA FROM TB_RUMAH_PUMPPIT WHERE NAMA_PUMPPIT='$namapumppit'";
  $datajmlpompa=oci_parse($conn,$sqljmlpompa);
  oci_execute($datajmlpompa);
  $row=oci_fetch_assoc($datajmlpompa);
  if($row){
    $pumppitID=strtolower($row['NAMA_PUMPPIT']);
    $jmlpompa=$row['JUMLAH_POMPA'];
    if($jmlpompa>=1){
      echo "<tr>";
      for($x=1;$x<=$jmlpompa;$x++){
        echo "<td class='iconbody'><img src='dist/pump_broken.png' id='".$pumppitID."_".$x."'></td>";
      }
      echo "<td rowspan='2' width='46px' class='text-end' id='".$pumppitID."_usonic_tx'>0cm</td></tr><tr>";
      for($x=1;$x<=$jmlpompa;$x++){
        echo "<td>P".$x."</td>";
      }
      echo "</tr>";
    }else{echo "<tr><td class='p-2'>No pump is set<br>in the database</td>
                <td width='46px' class='text-end' id='".$pumppitID."_usonic_tx'>0cm</td></tr>";}   
  }
}
/*
<tr>
  <td class="iconbody"><img src="dist/pump_broken.png" id="kbb1_1"></td>
  <td class="iconbody"><img src="dist/pump_broken.png" id="kbb1_2"></td>
  <td class="iconbody"><img src="dist/pump_broken.png" id="kbb1_3"></td>
  <td rowspan="2" width="46px" class="text-end" id="kbb1_usonic_tx">0cm</td>
</tr>
<tr>
  <td>P1</td>
  <td>P2</td>
  <td>P3</td>
</tr>
*/

// AMBIL DATA LEVEL PASUT
$oraquery="SELECT BAHAYA_TERTINGGI,WASPADA_TERTINGGI,AMAN_TERTINGGI,AMAN_TERENDAH FROM LEVELMLWS WHERE ID=1";

$ambildata=oci_parse($conn,$oraquery);
oci_execute($ambildata);
$oraRow = oci_fetch_array($ambildata);

$rowbahaya=$oraRow['BAHAYA_TERTINGGI'];
$viewBahaya=number_format($rowbahaya ,1,".","");

$rowwaspada=$oraRow['WASPADA_TERTINGGI'];
$viewWaspada=number_format($rowwaspada ,1,".","");

$rowaman=$oraRow['AMAN_TERTINGGI'];
$viewAman=number_format($rowaman ,1,".","");

$rowamanlow=$oraRow['AMAN_TERENDAH'];
$viewAmanLow=number_format($rowamanlow ,1,".","");
oci_free_statement($ambildata);
?>
<!doctype html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="dist/favicon.png">
    <link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dist/custombutton/custombutton.css">
    <!-- <link href="dist/bootstrap/bootstrap-icons.min.css" rel="stylesheet" > -->
    <script type="text/javascript" src="dist/bootstrap/bootstrap.bundle.min.js"></script>
	  <script type="text/javascript" src="dist/jquery/jquery-3.7.1.min.js"></script>
    <script type="text/javascript">
      
    </script>
    <style>
      #bgimg{
        width:1920px;
        height:1080px;
        background-size:1920px;
        background-color:#000;
        background-image:url('dist/semarang_port_mapv3_efx.min.jpg');
        background-repeat:no-repeat;
        -webkit-transition:all 5s linear;
        -moz-transition:all 5s linear;
        transition:all 5s linear;
        /*-moz-transition-property:all;
        -moz-transition-duration:9s;
        -moz-transition-timing-function:linear;*/
      }

      .cardpump{
        z-index:9;
        text-shadow:0 0 5px black;box-shadow:-2px 2px 5px black;
        background:rgba(0,0,0,0);cursor:pointer; /*initiate transparent value*/
      }
      .cardheadbody{background:rgba(5,116,190,0.6);color:#ddd;} /*bg & text color of card*/

      .iconhead{width:23px;} /*width & spacing icon png in table card */
      .iconhead img{width:20px;} /*width the icon png img */

      .iconbody{width:40px;} /*width & spacing icon png in table card */
      .iconbody img{width:33px;} /*width the icon png img */

      .water-usonic{
        width:100%;bottom:0px;border-radius:0px 0px 13px 13px;
        transition:all 1s linear;
      }

      .gaug{display:none;}  /*initialize hidden gauge svg */
      .gaug div{width:auto;height:auto;color:white;} /*dimension gauge svg */

      .hovr:hover .gaug{
        display:inline;
      }
      .hovr:hover{background:#2d5463;z-index:99;}  /*hover bg color*/

      .sidemenu-child{display:none;}
      .sidemenu-head{border-radius:13px 0px 0px 13px;}
      .sidemenu:hover .sidemenu-head{border-radius:13px 0px 0px 0px;}/* :hover      */
      .sidemenu:hover .sidemenu-child{display:inline;width:280px;}/*      */


      .icoani{animation:icoframe 5s linear infinite;} /*animation icon sidemenu*/
      @keyframes icoframe {
        0%  {color:white; transform: rotate(0deg);}
        50% {color:black; transform: rotate(180deg);}
        100%{color:white; transform: rotate(360deg);}
      }

      .nameLabel{background:rgba(255,255,255,0.8);}

      .custom-tooltip{
        --bs-tooltip-bg:#123;
/*        --bs-tooltip-color: #333;*/
      }

      polyline{fill:none;stroke:white;stroke-width:3;} /*svg lines stroke*/
      .bggradien{background:linear-gradient(to right, rgba(13,110,253,0.9), rgba(85,183,227,0.9));}/*rgba(14,115,185,1)*/

    </style>
  </head>
  
  <body>
    <!-- ***************** start web content container ***************** -->
    <div class="container-fluid" id="bgimg"><!-- ***************** MAP IMAGE ***************** -->

      <div class="position-relative" >
        
        <!-- ***************** JAM & CUACA & PASUT ***************** -->
        <div class="position-absolute row fw-bolder fs-5" style="left:15px;top:15px;color:LightGray;text-shadow:0px 0px 7px black;width:700px;">
          <div class="col" >
            <div class="row row-cols-1">
              <div class="col fs-3" style="width:auto;line-height:1;">Tanjung Emas Semarang</div>
              <div class="col" id="datetime" style="width:auto;"></div>
            </div>
            <div class="row row-cols-2 " style="line-height:4;">
              <div class="col-2" id="airpasut">
                <!-- <svg xmlns="" width="50" height="50" fill="currentColor" viewBox="0 0 16 16" style="transition:all 2s linear;">
                  <path d="M.036 3.314a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0L.314 3.964a.5.5 0 0 1-.278-.65m0 3a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0L.314 6.964a.5.5 0 0 1-.278-.65m0 3a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0L.314 9.964a.5.5 0 0 1-.278-.65m0 3a.5.5 0 0 1 .65-.278l1.757.703a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.014-.406a2.5 2.5 0 0 1 1.857 0l1.015.406a1.5 1.5 0 0 0 1.114 0l1.757-.703a.5.5 0 1 1 .372.928l-1.758.703a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.014-.406a1.5 1.5 0 0 0-1.114 0l-1.015.406a2.5 2.5 0 0 1-1.857 0l-1.757-.703a.5.5 0 0 1-.278-.65"/>
                </svg> -->
                <img src="dist/svg/waves.svg" width="55px" height="">
              </div>
              <div class="col fs-6" id="sensorpasut" style="width:auto;letter-spacing:2px;">MLWS</div>
            </div>
            <div class="row row-cols-3 fs-6">
              <div class="col-auto">
                <div id="bmkgcard" class="card border-light border-2 rounded-4 fs-6 text-light" style="width:auto;background:rgba(168, 168, 168, 0.6);">
                  <div class="d-flex align-items-center text-center fw-semibold">
                    <div class="p-1"><img id="iconbmkgcard" src="dist/Logo_bmg.gif" style="width:50px;"></div>
                    <div class="p-1">
                      <div>
                        <b>Water Level</b>
                        <svg width="21" height="21" fill="currentColor" viewBox="0 0 16 16">
                          <path d="M13.5 0a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V7.5h-1.5a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V15h-1.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V.5a.5.5 0 0 0-.5-.5zM7 1.5l.364-.343a.5.5 0 0 0-.728 0l-.002.002-.006.007-.022.023-.08.088a29 29 0 0 0-1.274 1.517c-.769.983-1.714 2.325-2.385 3.727C2.368 7.564 2 8.682 2 9.733 2 12.614 4.212 15 7 15s5-2.386 5-5.267c0-1.05-.368-2.169-.867-3.212-.671-1.402-1.616-2.744-2.385-3.727a29 29 0 0 0-1.354-1.605l-.022-.023-.006-.007-.002-.001zm0 0-.364-.343zm-.016.766L7 2.247l.016.019c.24.274.572.667.944 1.144.611.781 1.32 1.776 1.901 2.827H4.14c.58-1.051 1.29-2.046 1.9-2.827.373-.477.706-.87.945-1.144zM3 9.733c0-.755.244-1.612.638-2.496h6.724c.395.884.638 1.741.638 2.496C11 12.117 9.182 14 7 14s-4-1.883-4-4.267"/>
                        </svg><br>
                        <span id="wlevelbmkg">0 </span><sub> meter</sub>
                      </div>
                      <hr class="border border-light border-1 opacity-100">
                      <div>
                        <b>Windspeed</b>
                        <svg width="21" height="21" fill="currentColor" viewBox="0 0 16 16">
                          <path d="M12.5 2A2.5 2.5 0 0 0 10 4.5a.5.5 0 0 1-1 0A3.5 3.5 0 1 1 12.5 8H.5a.5.5 0 0 1 0-1h12a2.5 2.5 0 0 0 0-5m-7 1a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 2 2h-5a.5.5 0 0 1 0-1h5a1 1 0 0 0 0-2M0 9.5A.5.5 0 0 1 .5 9h10.042a3 3 0 1 1-3 3 .5.5 0 0 1 1 0 2 2 0 1 0 2-2H.5a.5.5 0 0 1-.5-.5"/>
                        </svg><br>
                        <span id="wspeedbmkg">0 </span><sub> knot</sub>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col ">
            <img src="dist/weather/animated/day/800.svg" style="width:65px;line-height:1;" id="iconWeather">
            <!-- <div class="fs-6" style="line-height: 0.6;" id="cuaca"></div> -->
          </div>
          <!-- Force next columns to break to new line
          <div class="w-100"></div> -->
        </div>
        <!-- ***************** PASUT RIGHT SIDE CARD ***************** -->
        <div id="pasutcard" class="card position-absolute border-light border-2 rounded-4 fs-6 text-light" style="width:auto;left:1555px;top:100px;background:rgba(168, 168, 168, 0.6);transition:all 1s ease;">
            <div class="d-flex align-items-center text-center fw-semibold">
              <div class="p-2"><img id="iconpasutcard" src="dist/svg/wifi-off.svg" style="width:40px; height:40px;"></div>
              <div class="p-2">
                <div id="statuspasutcard">OFFLINE</div>
                <div>
                  Tinggi Gelombang <span id="sensorpasutcard">0 MLWS</span>
                </div>
              </div>
            </div>
        </div>

        <!-- ***************** LOGO ***************** -->
        <div class="position-absolute" style="left:1555px;top:15px;">
            <img src="dist/logo_pelindo.png" id="logo" style="height:65px;transition:all 5s linear; ">
        </div>
        
        <div class="row position-absolute fw-bolder" style="left:15px;top:150px;color:LightGray;text-shadow:0px 0px 7px black;">            
          <div class="col">
            <!-- <img src="" style="width:70px;" id="iconWeather"> -->
            <!-- <div class="col display-3" style="line-height: 0.7;" id="suhu"></div> -->
            <!-- <div class="col fs-5" style="line-height: 2.1;" id="cuaca"></div> -->
          </div>
        </div>
      </div>  <!-- end of relative position PART_1 -->
      

      <div class="position-relative">
        <div class="" id="mainwidget" style="transition:visibility .5s linear,opacity .5s linear;">
          <!-- _________________ CARD of KBB 1 _________________ -->
          <a target="_blank" href="detail_pump.php?p=kbb1">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:300px;top:197px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>KBB 1</td>
                  <td class="text-end iconhead"><img src="" id="kbb1_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="kbb1_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"KBB1"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="kbb1_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="kbb1_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="kbb1_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="kbb1_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="kbb1_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours M1 (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of KBB 2 _________________ -->
          <a target="_blank" href="detail_pump.php?p=kbb2">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:100px;top:387px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>KBB 2</td>
                  <td class="text-end iconhead"><img src="" id="kbb2_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="kbb2_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"KBB2"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="kbb2_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="kbb2_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="kbb2_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="kbb2_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="kbb2_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of KBB 3 _________________ -->
          <a target="_blank" href="detail_pump.php?p=kbb3">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:25px;top:550px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>KBB 3</td>
                  <td class="text-end iconhead"><img src="" id="kbb3_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="kbb3_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"KBB3"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="kbb3_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="kbb3_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="kbb3_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="kbb3_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="kbb3_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of KBT KEPANDUAN _________________ -->
          <a target="_blank" href="detail_pump.php?p=kepanduan">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:440px;top:492px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>KEPANDUAN</td>
                  <td class="text-end iconhead"><img src="" id="kepanduan_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="kepanduan_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"KEPANDUAN"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="kepanduan_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="kepanduan_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="kepanduan_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="kepanduan_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="kepanduan_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of AMPENAN _________________ -->
          <a target="_blank" href="detail_pump.php?p=ampenan">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:440px;top:632px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>AMPENAN</td>
                  <td class="text-end iconhead"><img src="" id="ampenan_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="ampenan_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"AMPENAN"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="ampenan_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="ampenan_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="ampenan_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="ampenan_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="ampenan_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of DELI _________________ -->
          <a target="_blank" href="detail_pump.php?p=deli">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:440px;top:349px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>DELI</td>
                  <td class="text-end iconhead"><img src="" id="deli_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="deli_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"DELI"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="deli_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="deli_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="deli_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="deli_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="deli_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of CLUSTER 3 _________________ -->
          <a target="_blank" href="detail_pump.php?p=cluster3">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:850px;top:597px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>CLUSTER 3</td>
                  <td class="text-end iconhead"><img src="" id="cluster3_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="cluster3_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"CLUSTER3"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="cluster3_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="cluster3_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="cluster3_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="cluster3_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="cluster3_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of Term.PENUMPANG _________________ -->
          <a target="_blank" href="detail_pump.php?p=terminal_penumpang">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:602px;top:127px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>Term.PENUMPANG</td>
                  <td class="text-end iconhead"><img src="" id="terminal_penumpang_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="terminal_penumpang_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"TERMINAL_PENUMPANG"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="terminal_penumpang_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="terminal_penumpang_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="terminal_penumpang_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="terminal_penumpang_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="terminal_penumpang_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours M1 (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of KANTOR _________________ -->
          <a target="_blank" href="detail_pump.php?p=kantor">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:1246px;top:352px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>KANTOR</td>
                  <td class="text-end iconhead"><img src="" id="kantor_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="kantor_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"KANTOR"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="kantor_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="kantor_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="kantor_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="kantor_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="kantor_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of BEST  _________________ -->
          <a target="_blank" href="detail_pump.php?p=best">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:1100px;top:597px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>BEST</td>
                  <td class="text-end iconhead"><img src="" id="best_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="best_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"BEST"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="best_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="best_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="best_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="best_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="best_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of RTK TIMUR _________________ -->
          <a target="_blank" href="detail_pump.php?p=rtk_timur">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:1676px;top:760px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>RTK TIMUR</td>
                  <td class="text-end iconhead"><img src="" id="rtk_timur_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="rtk_timur_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"RTK_TIMUR"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="rtk_timur_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="rtk_timur_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="rtk_timur_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="rtk_timur_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="rtk_timur_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of PRASASTI _________________ -->
          <a target="_blank" href="detail_pump.php?p=prasasti">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:831px;top:37px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>PRASASTI</td>
                  <td class="text-end iconhead"><img src="" id="prasasti_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="prasasti_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"PRASASTI"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="prasasti_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# d-flex flex-row   p-1 align-self-stretch text-center -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="prasasti_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="prasasti_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="prasasti_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="prasasti_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of CY 1 _________________ -->
          <a target="_blank" href="detail_pump.php?p=cy1">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:1246px;top:37px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>CY 1</td>
                  <td class="text-end iconhead"><img src="" id="cy1_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="cy1_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php echo jumlahPompa($conn,"CY1");?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="cy1_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="cy1_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="cy1_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="cy1_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="cy1_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of CY 2 _________________ -->
          <a target="_blank" href="detail_pump.php?p=cy2">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:1246px;top:189px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>CY 2</td>
                  <td class="text-end iconhead"><img src="" id="cy2_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="cy2_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"CY2"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="cy2_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="cy2_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="cy2_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="cy2_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="cy2_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of CY 4 _________________ -->
          <a target="_blank" href="detail_pump.php?p=cy4" >
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:1437px;top:352px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr  ><td>CY 4</td>
                  <td class="text-end iconhead"><img src="" id="cy4_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="cy4_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"CY4"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="cy4_usonic" ></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="cy4_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="cy4_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="cy4_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="cy4_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________ CARD of CLUSTER 2 _________________ -->
          <a target="_blank" href="detail_pump.php?p=cluster2">
          <div class="card position-absolute border-light border-2 rounded-4 cardpump hovr" style="width:auto;left:1600px;top:189px;">
            <!-- #CARD HEAD# -->
            <div class="card cardheadbody" style="border-radius:13px 13px 0px 0px;">
              <table class="m-1 fw-bold z-3">
                <tr><td>CLUSTER 2</td>
                  <td class="text-end iconhead"><img src="" id="cluster2_pln"></td><!-- $id -->
                  <td class="text-end iconhead"><img src="dist/no-signal-icon.png" id="cluster2_conn"></td><!-- $id -->
                </tr>
              </table>
            </div>
            <!-- #CARD BODY# -->
            <div class="card cardheadbody" style="border-radius:0px 0px 13px 13px;font-size:0.8em;">
              <div class="text-center fw-bold font-monospace ps-1 pt-1 z-3">
                <table>
                <?php jumlahPompa($conn,"CLUSTER2"); ?>
                </table>
              </div>
              <div class="position-absolute water-usonic" id="cluster2_usonic"></div><!-- $id -->
            </div>
            <!-- #CARD HOVER# -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto font-monospace gaug" style="font-size:13px;">
                <div id="cluster2_gage_1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Apparent Power (kVA)">0 kVA</div><!-- $id -->
                <div id="cluster2_gage_2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Voltage (V)">0 V</div><!-- $id -->
                <div id="cluster2_gage_3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Current (A)">0 A</div><!-- $id -->
                <div id="cluster2_gage_4" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Run Hours (Hours)">0 Hrs</div><!-- $id -->
              </div>
            </div>
          </div></a>

          <!-- _________________SMOKE ANIMATION_________________ -->
          <!-- _MAIN smokestack_ -->
          <div class="position-absolute" style="width:auto;left:1535px;top:302px;z-index:0">
            <img src="dist/smoke.gif">
          </div>
          <!-- _OTHER smokestack_ -->
          <div class="position-absolute" style="width:auto;left:1351px;top:251px;z-index:0;filter: invert(100%);transition:1s;">
            <img src="dist/smoke.gif">
          </div>

          <!-- _________________LINE POINT of CARD WIDGET_________________ -->
          <svg height="1060" width="1900">
            <filter id="shadow">
              <feDropShadow dx="-3" dy="3" stdDeviation="1" flood-opacity="0.7"/>
            </filter>

            <!-- #_KBB 1_# -->
            <polyline points="555,285 524,234 442,234" filter="url(#shadow)"/>
            <circle r="5" cx="555" cy="285" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>

            <!-- #_KBB 2_# -->
            <polyline points="308,434 300,424 242,424" filter="url(#shadow)"/>
            <circle r="5" cx="308" cy="434" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>

            <!-- #_KBB 3_# -->
             <polyline points="6,705 93,705 93,638" filter="url(#shadow)"/>
            <circle r="5" cx="6" cy="705" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_KBT KEPANDUAN_# -->
             <polyline points="397,425 397,530 441,530" filter="url(#shadow)"/>
            <circle r="5" cx="397" cy="425" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_AMPENAN_# -->
             <polyline points="257,652 265,670 441,670" filter="url(#shadow)"/>
            <circle r="5" cx="257" cy="652" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_DELI_# -->
            <polyline points="608,304 575,304 530,351" filter="url(#shadow)"/>
            <circle r="5" cx="608" cy="304" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_CLUSTER 3_# -->
            <polyline points="781,734 795,635 851,635" filter="url(#shadow)"/>
            <circle r="5" cx="781" cy="734" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_Term.PENUMPANG_# -->
            <polyline points="958,283 841,165 808,165" filter="url(#shadow)"/>
            <circle r="5" cx="958" cy="283" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_KANTOR_# -->
            <polyline points="1193,371 1201,390 1251,390 " filter="url(#shadow)"/>
            <circle r="5" cx="1193" cy="371" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_BEST_# -->
            <polyline points="1150,497 1175,523 1175,601" filter="url(#shadow)"/>
            <circle r="5" cx="1150" cy="497" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_RTK TIMUR_# -->
            <polyline points="1871,982 1758,982 1758,853" filter="url(#shadow)"/>
            <circle r="5" cx="1871" cy="982" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.3s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_PRASASTI_# -->
            <polyline points="1055,185 1041,75 1007,75" filter="url(#shadow)"/>
            <circle r="5" cx="1055" cy="185" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.5s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_CY 1_# -->
            <polyline points="1116,141 1170,75 1251,75" filter="url(#shadow)"/>
            <circle r="5" cx="1116" cy="141" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.5s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_CY 2_# -->
            <polyline points="1170,210 1180,227 1251,227" filter="url(#shadow)"/>
            <circle r="5" cx="1170" cy="210" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.5s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_CY 4_# -->
            <polyline points="1211,313 1385,313 1440,360 " filter="url(#shadow)"/>
            <circle r="5" cx="1211" cy="313" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.5s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            <!-- #_CLUSTER 2_# -->
            <polyline points="1433,275 1484,227 1601,227 " filter="url(#shadow)"/>
            <circle r="5" cx="1433" cy="275" stroke="black" fill="#5ac000"><animate attributeName="r" begin="0.5s" dur="2s" from="2" to="7" repeatCount="indefinite"/></circle>
            
            Update browser anda ke versi terbaru !! Update your browser to the latest version to see the magical content !!
          </svg>
        </div><!-- end of MainWidget -->
        <div class="" id="labelname" style="transition:visibility .5s linear,opacity .5s linear;">
          <!-- _________________ CARD Name Samudera _________________ -->
          <div class="card position-absolute border-light border-1 rounded-2 fst-italic fw-semibold p-1 nameLabel" style="width:auto;left:935px;top:220px;">
            D.Samudera
          </div>
          <!-- _________________ CARD Name Nusantara _________________ -->
          <div class="card position-absolute border-light border-1 rounded-2 fst-italic fw-semibold p-1 nameLabel" style="width:auto;left:900px;top:345px;">
            D.Nusantara
          </div>
          <!-- _________________ CARD Name TPKS _________________ -->
          <div class="card position-absolute border-light border-1 rounded-2 fst-italic fw-semibold p-1 nameLabel" style="width:auto;left:1120px;top:165px;">
            TPKS
          </div>
          <!-- _________________ CARD Name Kantor TjEmas _________________ -->
          <div class="card position-absolute border-light border-1 rounded-2 fst-italic fw-semibold p-1 text-center nameLabel" style="width:8em;left:1055px;top:360px;">
            Kantor Reg.3 Pelindo Tj.Emas
          </div>
        </div><!-- end of LabelName -->
      </div>  <!-- end of relative position PART_2 -->
    
    
        
      
    </div>                  <!-- ***************** end of web content container ***************** -->



<!-- ***************************************** SUMMARY Accordion ***** -->
      <div class="accordion accordion-flush position-fixed bottom-0 start-0 end-0" id="deviceSummary" style="z-index:100;">
        <div class="accordion-item" style="background:rgba(0,0,0,0);">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed fw-bolder fs-2 bggradien" data-bs-toggle="collapse" data-bs-target="#contentSummary" aria-expanded="false" style="color:whitesmoke;line-height:0.6;letter-spacing:5px;">Summary</button>
            <!-- background:rgba(13,110,253,0.9); -->
          </h2>
          <div class="accordion-collapse collapse" id="contentSummary" data-bs-parent="#deviceSummary" style=" background:linear-gradient(to right,rgba(0,191,255,0.9),rgba(221,255,255,0.9));"><!-- rgba(173,216,230,0.9) -->
            <div class="accordion-body">
              <div class="d-flex flex-row">
                <div class="p-1 align-self-stretch text-center">
                  <div class="fw-semibold">Pompa Idle</div>
                  <span id="p_idle" class="align-middle fs-2 font-monospace" style="line-height:0.7;">&#8709;</span><img src="dist/Pump_idle_summary_icon.png" width="40px"><!-- ID pump summ -->
                  <hr>
                  <div class="fw-semibold">Pompa On</div>
                  <span id="p_on" class="align-middle fs-2 font-monospace" style="line-height:0.7;">&#8709;</span><img src="dist/Pump_run_summary_icon.png" width="40px"><!-- ID pump summ -->
                </div>
                <div class="vr ms-1 me-1" style="width:2px;"></div>
                <div class="p-1 align-self-stretch text-center">
                  <div class="fw-semibold">Pompa Warning</div>
                  <span id="p_warning" class="align-middle fs-2 font-monospace" style="line-height:0.7;">&#8709;</span><img src="dist/Pump_warning_summary_icon.png" width="40px"><!-- ID pump summ -->
                  <hr>
                  <div class="fw-semibold">Pompa Maintenance</div>
                  <span id="p_maintenance" class="align-middle fs-2 font-monospace" style="line-height:0.7;">&#8709;</span><img src="dist/Pump_maintenance_summary_icon.png" width="40px"><!-- ID pump summ -->
                </div>
                <div class="vr ms-1 me-1 " style="width:2px;"></div>
                <div class="p-1 align-self-stretch text-center">
                  <img src="dist/weather/animated/day/800.svg" style="width:70px;" id="iconSummary">
                  <div class="col display-6" style="line-height: 0.7;" id="suhuSummary">°C</div>
                </div>
                <div class="vr ms-1 me-1" style="width:2px;"></div>
                <div class="p-1 align-self-stretch text-center">
                  <div class="fw-semibold">TINGGI GELOMBANG<br>PASUT PELINDO</div>
                  <div class="fw-semibold font-monospace" id="sensorpasutsummary" style="width:auto;">MLWS</div>
                  <div class="fw-semibold font-monospace" id="statuspasutsummary" style="width:auto;"><span>Offline</span></div>
                </div>
                <div class="vr ms-1 me-1" style="width:2px;"></div>
                <div class="p-1 align-self-stretch text-center">
                  <div class="fw-semibold">NOTIFIKASI</div>
                </div>
              </div>

              <!-- <table class="fw-bolder" width="100%">
                <tr>
                  <td></td>
                  <td colspan="4" class="fs-4 text-center align-middle">STATISTIK POMPA</td>
                </tr>
                <tr>
                  <td>&nbsp</td>
                  <td><img src="dist/pompa_STANDBY.png" style="height:130px;"></td>
                  <td><img src="dist/POMPA_ON_ANIMATION.gif" style="height:130px;"></td>
                  <td><img src="dist/pompa_warning.png" style="height:130px;"></td>
                  <td><img src="dist/pompa_rusak.png" style="height:130px;"></td>
                </tr>
              </table> -->

            </div>
          </div>
        </div>
      </div>


<!-- ***************************************** Mini Side Menu ***** -->
      <div class="card border-0 sidemenu position-fixed" style="right:1px;top:45%;z-index:100;background:rgba(0,0,0,0);text-shadow:0px 0px 7px black;transition:all 2s;">
        
        <div class="card p-2 fw-bolder sidemenu-head bggradien" style="color:whitesmoke;">
          <table>
            <tr>
              <!-- animated GEAR -->
              <td class="">
                <!-- <svg xmlns="" width="31" height="31" fill="currentColor" class="bi bi-gear-fill icoani" viewBox="0 0 16 16">
              <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
              </svg> -->
              <img src="dist/svg/gear-spinner.svg" height="35px">
            </td>
              <td class="sidemenu-child fs-5">Menu Settings</td>
            </tr>
          </table>
        </div>

        <div class="card ps-2 pb-2 fw-semibold sidemenu-child bggradien" style="color:whitesmoke;border-radius:0px 0px 0px 13px;">
                <div class="">
                  <u>Map Menu</u>
                  <table class="text-center " style="width:100%;">
                    <tr>
                      <td>
                        <label class="cssbutton">
                          <input type="radio" name="mapmode" onclick="sunmode('zone')">
                          <div class="cssmark"></div>
                        </label>
                      </td>
                      <td>
                        <label class="cssbutton">
                          <input type="checkbox" name="labeling" id="widget" checked onclick="showcard('mainwidget')">
                          <div class="cssmark"></div>
                        </label>
                      </td>
                      <td>
                        <label class="cssbutton">
                          <input type="checkbox" name="labeling" id="label" checked onclick="showcard('labelname')">
                          <div class="cssmark"></div>
                        </label>
                      </td>
                    </tr>
                    <tr style="line-height:0.6;">
                      <td><svg xmlns="" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                          <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                        </svg> Zonasi</td>
                      <td><svg xmlns="" width="16" height="16" fill="currentColor" class="bi bi-columns-gap" viewBox="0 0 16 16">
                        <path d="M6 1v3H1V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm14 12v3h-5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM6 8v7H1V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm14-6v7h-5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z"/>
                        </svg> Widget</td>
                      <td><svg xmlns="" width="16" height="16" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
                        <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                        <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z"/>
                        </svg> Label</td>
                    </tr>
                  </table>
                </div>
            <hr class="border border-2 ">
                <div class="" >
                  <u>Map Mode</u>
                  <table class="text-center" style="width:100%;">
                    <tr>
                      <td>
                        <label class="cssbutton">
                          <input type="radio" name="mapmode" onclick="sunmode('rise')">
                          <div class="cssmark"></div>
                        </label>
                      </td>
                      <td>
                        <label class="cssbutton">
                          <input type="radio" name="mapmode" checked onclick="intervalWeather()">
                          <div class="cssmark"></div>
                        </label>
                      </td>
                      <td>
                        <label class="cssbutton">
                          <input type="radio" name="mapmode" onclick="sunmode('set')">
                          <div class="cssmark"></div>
                        </label>
                      </td>
                    </tr>
                    <tr style="line-height:0.6;">
                      <td><span style="color:white;font-size:20px;">&#9788;</span> Day</td>
                      <td><span style="color:white;font-size:20px;">&#9680;</span> Auto</td>
                      <td><span style="color:white;font-size:20px;">&#9214;</span> Night</td>  
                    </tr>
                  </table>
                </div>
        </div>
        
      </div>
<!-- ***************************************** End of Mini Side Menu ***** -->


<script type="text/javascript">

    function displayCurrentDateTime() {
      const now = new Date(); // Mendapatkan waktu saat ini

      const days = ["Sun","Mon","Tue","Wed", "Thu", "Fri", "Sat"];
      const day = days[now.getDay()]
      const date = now.getDate()
      const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
      const month = months[now.getMonth()]
      const year = now.getFullYear()
      const hours = String(now.getHours()).padStart(2, '0')
      const minutes = String(now.getMinutes()).padStart(2, '0')
      const seconds = String(now.getSeconds()).padStart(2, '0')
      const zone = now.getTimezoneOffset()

      if(zone == -420){tmzon="WIB"}
      else if(zone == -480){tmzon="WITA"}
      else if(zone == -540){tmzon="WIT"}
        else{
          let gmt=zone/-60
          let minu = Math.abs(zone % 60)
          let hr = Math.floor(gmt)
          if (gmt<0) {tmzon="UTC"+hr+"."+minu}
          else if (gmt>=0) {tmzon="UTC+"+hr+"."+minu}
        }

      const currentDateTime = `${day}, ${date} ${month} ${year}<br>${hours}:${minutes}:${seconds} ${tmzon}`;
      document.getElementById('datetime').innerHTML=currentDateTime
    }

    //FETCHING API DATA
    async function dataApi(url){
      const apiSensor = await fetch(url)
      return await apiSensor.json()
    }

    // CURRENT EPOCH UNIX TIME
    function waktu() {
        let atnowtime = Math.floor(Date.now()/1000) //current time
        return atnowtime
    }
    const offlineDuration=180   //SELISIH RANGE WAKTU JIKA MENGALAMI OFFLINE 3 menit

    // STATUS ON-OFF POMPA
    function pumpStatus(uri,interval,idpump1,idpump2,idpump3){
        const fetchData = async () => {
            try {
                const dat = await dataApi(uri)
                let statPum1=dat.data.statusPump1
                let statPum2=dat.data.statusPump2
                let statPum3=dat.data.statusPump3
                let apiTime=dat.data.request
                let atNow=waktu()
                let difTime=Math.abs(apiTime-atNow)

                let domOn = (id) => {
                  return document.getElementById(id).src='dist/Pompa_p1_on.gif'}
                let domOff = (id) => {
                  return document.getElementById(id).src='dist/pump_standby.png'}

                if(typeof idpump1!=='undefined' || idpump1!==null){
                    if (offlineDuration>=difTime) {
                      if(statPum1=="ON"){
                        domOn(idpump1)
                      } 
                      else{domOff(idpump1)}}
                    else{document.getElementById(idpump1).src='dist/pump_broken.png'}
                }
                if(typeof idpump2!=='undefined' || idpump1!==null){
                    if (offlineDuration>=difTime) {
                      if(statPum2=="ON"){
                        domOn(idpump2)
                      }
                      else{domOff(idpump2)}}
                    else{document.getElementById(idpump2).src='dist/pump_broken.png'}
                }
                if(typeof idpump3!=='undefined' || idpump1!==null){
                    if (offlineDuration>=difTime) {
                      if(statPum3=="ON"){
                        domOn(idpump3)
                      }
                      else{domOff(idpump3)}}
                    else{document.getElementById(idpump3).src='dist/pump_broken.png'}
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

//FUNGSI PARAMETER POMPA
function pumpParameter(uri,interval,idsignal,idpln,idwater,idkva,idvolt,idampere,idrun) {
    const fetchData = async () => {
        try {
          const dat = await dataApi(uri)

          let usonic=dat.data.ultrasonic
          let apparpower=dat.data.apparentPower
          let vL1=dat.data.voltageL1_N
          let aL1=dat.data.currentL1
          let runM1=dat.data.runhourM1

          let apiTime=dat.data.request
          let atNow=waktu()
          let difTime=Math.abs(apiTime-atNow)

          let water=100-((usonic/300)*100) //reverse ultrasonic
          let waterText=idwater+"_tx"
          let bgColor='rgba(50,182,233, 0.7)' //normal water 10,90,255 #0055ee #FFD700 #DC143C
          if(water>=100){water=100}

          if (offlineDuration>=difTime) {
            if(water>=50 && water<80){bgColor='rgba(255,193,7, 0.6)'} //warning water
            if(water>=80){bgColor='rgba(255,13,29, 0.6)'} //danger water

            document.getElementById(idwater).style.height=water.toString()+"%"
            document.getElementById(idwater).style.background=bgColor
            document.getElementById(waterText).innerHTML=usonic.toString()+"cm"
            document.getElementById(idsignal).src='dist/signal-icon.png'
            document.getElementById(idpln).src='dist/pln_icon.png'
            document.getElementById(idkva).innerHTML=apparpower+" kVA"
            document.getElementById(idvolt).innerHTML=vL1+" V"
            document.getElementById(idampere).innerHTML=aL1+" A"
            document.getElementById(idrun).innerHTML=runM1+" Hrs"
          }
          else{
            document.getElementById(idwater).style.height=0+"%"
            document.getElementById(idwater).style.background=bgColor
            // document.getElementById(waterText).innerHTML="0cm"
            // document.getElementById(id5).src='dist/no-signal-icon.png'
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

// PASUT tanjungemas - PASANG SURUT AIR LAUT
/*
function pasutairlaut() {
  const fetchData = async () => {
        try {
          const respon = await dataApi('https://www.tanjungemas.com/api/pasut_restapi.php')
          let uSonic=respon.realtime_data.ultrasonic
          let stat=respon.realtime_data.status
          let mlws;let warnaAir;let svgico;
          
          if(stat!="OFFLINE"){
            mlws=uSonic+" MLWS"
            if(stat=="AMAN"){warnaAir="rgba(50,210,50,0.7)";svgico="dist/svg/checkmark.svg"}// #32CD32
            else if(stat=="WASPADA"){warnaAir="rgba(255,193,7,0.7)";svgico="dist/svg/exclamation.svg"}//#ffc107
            else if(stat=="BAHAYA"){warnaAir="rgba(220,35,36,0.7)";svgico="dist/svg/exclamation.svg"}//#dc3545
            else{warnaAir="#777";svgico="dist/svg/no-file.svg" }
          }
          else{
            mlws="Offline";warnaAir="#777";svgico="dist/svg/wifi-off.svg"
          }

          document.getElementById("airpasut").style.color=warnaAir
          document.getElementById('sensorpasut').innerText=mlws
          document.getElementById('sensorpasutsummary').innerText=mlws
          document.getElementById('statuspasutsummary').innerText=stat
          // document.getElementById('sensorpasutsummary').style.color=warnaAir
          // document.getElementById('statuspasutsummary').style.color=warnaAir
          document.getElementById('pasutcard').style.background=warnaAir
          document.getElementById('sensorpasutcard').innerText=mlws
          document.getElementById('statuspasutcard').innerText=stat
          document.getElementById('iconpasutcard').src=svgico
          
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
pasutairlaut()
*/

function pasutmlws(uri,tbahaya,twaspada,taman){
  const fetchData = async () => {
    try {
      const dat = await dataApi(uri)

      let cm=dat.data.ultrasonic
      let request=dat.data.request
      let uSonic=cm/100
      let mlws;let warnaAir;let svgico;let stat;
          
      if(request!="0"){
        mlws="+"+uSonic.toFixed(3)+" MLWS"
        if(uSonic<=taman){stat="AMAN";warnaAir="rgba(50,210,50,0.7)";svgico="dist/svg/checkmark.svg"}// #32CD32
        else if(uSonic>taman && uSonic<twaspada){stat="WASPADA";warnaAir="rgba(255,193,7,0.7)";svgico="dist/svg/exclamation.svg"}//#ffc107
        else if(uSonic>=tbahaya){stat="BAHAYA";warnaAir="rgba(220,35,36,0.7)";svgico="dist/svg/exclamation.svg"}//#dc3545
        else{warnaAir="#777";svgico="dist/svg/no-file.svg" }
      }
      else{
        mlws="Offline";stat="Offline";warnaAir="#777";svgico="dist/svg/wifi-off.svg"
      }
      document.getElementById('sensorpasut').innerText=mlws
      document.getElementById("airpasut").style.color=warnaAir
      document.getElementById('sensorpasutsummary').innerText=mlws
      document.getElementById('statuspasutsummary').innerText=stat

      // document.getElementById('sensorpasutsummary').style.color=warnaAir
      // document.getElementById('statuspasutsummary').style.color=warnaAir

      document.getElementById('pasutcard').style.background=warnaAir
      document.getElementById('sensorpasutcard').innerText=mlws
      document.getElementById('statuspasutcard').innerText=stat
      document.getElementById('iconpasutcard').src=svgico

    }
    catch (error) {   //jika gagal mendapakan API JSON
    // console.error('Failed to fetch data:', error);
    }
  }
    //get first data
    fetchData()
    const intervalId = setInterval(fetchData, 5000)
    return () => clearInterval(intervalId)
}

let awsbmkg=function(){
  $.ajax({
    type: 'GET',
    url: "anti_cors_bmkg.php",
    data: {method: "ajax_request"},
    dataType: "json", // data type of response
    success: function(respon) {
      $('#wspeedbmkg').html(Number(Number(respon.windspeed) * 1.94384).toFixed(2))
      $('#wlevelbmkg').html(Number(respon.waterlevel).toFixed(2))
    }
  });
}
setInterval(awsbmkg, 5000);
window.onload=awsbmkg()

//weather function 
async function weather(param){
  const api=await fetch('https://api.openweathermap.org/data/2.5/weather?lat=-6.9464&lon=110.4246&appid=aeca8012dba8b9e855ca149019c055e2&units=metric')
  const response=await api.json()

  let cuaca=response.weather[0].description
  let kodecuaca=response.weather[0].icon
  let idcuaca=response.weather[0].id
  let suhu=response.main.temp.toFixed(0)+'°C'
  let sunrise=response.sys.sunrise
  let sunset=response.sys.sunset
  
  let timeOfDay
  let iconName
  let sun=[]

  // if default icon name contains the letter 'd'
  if(kodecuaca.indexOf('d') != -1) {
    timeOfDay = 'day';
    }
  else {
    timeOfDay = 'night';
    }

  let iconAni = `dist/weather/animated/${timeOfDay}/${idcuaca}.svg`;
  let val
  if(param=='cuaca'){val=cuaca}
  else if(param=='suhu'){val=suhu}
  else if(param=='icon'){val=iconAni}
  else if(param=='sun'){sun[0]=sunrise;sun[1]=sunset;val=sun;}
  else if(param=='suntime'){val=timeOfDay}
  return val
}

function intervalWeather(){
  weather('icon').then(result => {
    document.getElementById("iconWeather").src=result
  })
  // weather('cuaca').then(result => {
  //   document.getElementById("cuaca").innerHTML=result
  // })
  weather('suhu').then(result => {
    document.getElementById("suhuSummary").innerHTML=result
  })
  weather('icon').then(result => {
    document.getElementById("iconSummary").src=result
  })
  weather('sun').then(result => {
    let atNow=waktu()
    if(result[0]<=atNow && atNow<result[1]){sunmode('rise')} //auto sunrise
    else if(result[1]<=atNow || atNow<result[0]){sunmode('set')} //auto sunset
  })
}

// SUNRISE SUNSET MAP MODE
function sunmode(x){
  let img; let logo
  if(x=="rise"){img="url('dist/semarang_port_mapv3_efx.min.jpg')";filter="none"}
  else if(x=="set"){img="url('dist/semarang_port_nitev3_efx.min.jpg')";filter="invert(50%) brightness(180%)"}
  else if(x=="zone"){img="url('dist/semarang_port_map_zonasi.min.jpg')";filter="none"}
    document.getElementById("bgimg").style.backgroundImage=img
    document.getElementById("logo").style.filter=filter    
}

function showcard(idCard){
    let x=document.getElementById(idCard).style
    if(x.visibility==="hidden"){ x.visibility="visible";x.opacity=1;
    }
    else{ x.visibility="hidden";x.opacity=0 }
}
function clearcard(){
  let domCl=document.getElementById("clear").checked
  let domWdg=document.getElementById("widget").checked
  let domLbl=document.getElementById("label").checked
  if(domCl==false){
    domCl=true
    domWdg=false
    domLbl=false
    showcard("mainwidget")
    showcard("labelname")
  }
  else{
    domCl=false
    domWdg=true
    domLbl=true
  }
}

// SUMMARY PUMP STATUS
function activePump(){
  let pumpSelAll=document.querySelectorAll('img[src="dist/pump_broken.png"]').length;
  let pumpIdle=document.querySelectorAll('img[src="dist/pump_standby.png"]').length;
  let pumpOn=document.querySelectorAll('img[src="dist/Pompa_p1_on.gif"]').length;
  let pumpWarn=document.querySelectorAll('img[src="dist/pump_warning.png"]').length
  let pumpMainten=document.querySelectorAll('img[src="dist/pump_maintenance.png"]').length
  document.getElementById("p_idle").innerHTML=pumpIdle
  document.getElementById("p_on").innerHTML=pumpOn
  document.getElementById("p_warning").innerHTML=pumpWarn
  document.getElementById("p_maintenance").innerHTML=pumpMainten
}

setInterval(activePump,1000)
window.onload=intervalWeather       //get weather first data
setInterval(displayCurrentDateTime,1000)
setInterval(intervalWeather,180000)

const intervalAPI=5000
const hostapi="https://polder-api.pelindo.co.id"
const apiKbb1=hostapi+"/api/kbb1"
const apiKbb2=hostapi+"/api/kbb2"
const apiKbb3=hostapi+"/api/kbb3"
const apiKepanduan=hostapi+"/api/kepanduan"
const apiAmpenan=hostapi+"/api/ampenan"
const apiDeli=hostapi+"/api/deli"
const apiCluster3_1=hostapi+"/api/cluster3_1"
const apiCluster3_2=hostapi+"/api/cluster3_2"
const apiCluster3_3=hostapi+"/api/cluster3_3"
const apiTPenumpang=hostapi+"/api/tpenumpang"
const apiKantor=hostapi+"/api/kantor"
const apiBest=hostapi+"/api/best"
const apiRtkTimur=hostapi+"/api/rtktimur"
const apiPrasasti1=hostapi+"/api/prasasti1"
const apiPrasasti2=hostapi+"/api/prasasti2"
const apiCy1_1=hostapi+"/api/cy1_1"
const apiCy1_2=hostapi+"/api/cy1_2"
const apiCy1_3=hostapi+"/api/cy1_3"
const apiCy2=hostapi+"/api/cy2"
const apiCy4=hostapi+"/api/cy4"
const apiCluster2_1=hostapi+"/api/cluster2_1"
const apiCluster2_2=hostapi+"/api/cluster2_2"
const apiCluster2_3=hostapi+"/api/cluster2_3"

pumpStatus(apiKbb1,intervalAPI,'kbb1_1','kbb1_2','kbb1_3')
pumpStatus(apiKbb2,intervalAPI,'kbb2_1','kbb2_2','kbb2_3')
pumpStatus(apiKbb3,intervalAPI,'kbb3_1','kbb3_2','kbb3_3')
pumpStatus(apiKepanduan,intervalAPI,'kepanduan_1','kepanduan_2','kepanduan_3')
pumpStatus(apiAmpenan,intervalAPI,'ampenan_1','ampenan_2','ampenan_3')
pumpStatus(apiDeli,intervalAPI,'deli_1','deli_2','deli_3')
pumpStatus(apiCluster3_1,intervalAPI,'cluster3_1')
pumpStatus(apiCluster3_2,intervalAPI,'cluster3_2')
pumpStatus(apiCluster3_3,intervalAPI,'cluster3_3')
pumpStatus(apiTPenumpang,intervalAPI,'terminal_penumpang_1','terminal_penumpang_2','terminal_penumpang_3')
pumpStatus(apiKantor,intervalAPI,'kantor_1','kantor_2','kantor_3')
pumpStatus(apiBest,intervalAPI,'best_1','best_2','best_3')
pumpStatus(apiRtkTimur,intervalAPI,'rtk_timur_1','rtk_timur_2','rtk_timur_3')
pumpStatus(apiPrasasti1,intervalAPI,'prasasti_1','prasasti_2','prasasti_3')
// pumpStatus(apiPrasasti2,intervalAPI,'pras_3')
pumpStatus(apiCy1_1,intervalAPI,'cy1_1')
pumpStatus(apiCy1_2,intervalAPI,'cy1_2')
pumpStatus(apiCy1_3,intervalAPI,'cy1_3')
pumpStatus(apiCy2,intervalAPI,'cy2_1','cy2_2','cy2_3')
pumpStatus(apiCy4,intervalAPI,'cy4_1','cy4_2','cy4_3')
pumpStatus(apiCluster2_1,intervalAPI,'cluster2_1')
pumpStatus(apiCluster2_2,intervalAPI,'cluster2_2')
pumpStatus(apiCluster2_3,intervalAPI,'cluster2_3')

pumpParameter(apiKbb1,intervalAPI,'kbb1_conn','kbb1_pln','kbb1_usonic','kbb1_gage_1','kbb1_gage_2','kbb1_gage_3','kbb1_gage_4')
pumpParameter(apiKbb2,intervalAPI,'kbb2_conn','kbb2_pln','kbb2_usonic','kbb2_gage_1','kbb2_gage_2','kbb2_gage_3','kbb2_gage_4')
pumpParameter(apiKbb3,intervalAPI,'kbb3_conn','kbb3_pln','kbb3_usonic','kbb3_gage_1','kbb3_gage_2','kbb3_gage_3','kbb3_gage_4')
pumpParameter(apiKepanduan,intervalAPI,'kepanduan_conn','kepanduan_pln','kepanduan_usonic','kepanduan_gage_1','kepanduan_gage_2','kepanduan_gage_3','kepanduan_gage_4')
pumpParameter(apiAmpenan,intervalAPI,'ampenan_conn','ampenan_pln','ampenan_usonic','ampenan_gage_1','ampenan_gage_2','ampenan_gage_3','ampenan_gage_4')
pumpParameter(apiDeli,intervalAPI,'deli_conn','deli_pln','deli_usonic','deli_gage_1','deli_gage_2','deli_gage_3','deli_gage_4')
pumpParameter(apiCluster3_1,intervalAPI,'cluster3_conn','cluster3_pln','cluster3_usonic','cluster3_gage_1','cluster3_gage_2','cluster3_gage_3','cluster3_gage_4')
pumpParameter(apiTPenumpang,intervalAPI,'terminal_penumpang_conn','terminal_penumpang_pln','terminal_penumpang_usonic','terminal_penumpang_gage_1','terminal_penumpang_gage_2','terminal_penumpang_gage_3','terminal_penumpang_gage_4')
pumpParameter(apiKantor,intervalAPI,'kantor_conn','kantor_pln','kantor_usonic','kantor_gage_1','kantor_gage_2','kantor_gage_3','kantor_gage_4')
pumpParameter(apiBest,intervalAPI,'best_conn','best_pln','best_usonic','best_gage_1','best_gage_2','best_gage_3','best_gage_4')
pumpParameter(apiRtkTimur,intervalAPI,'rtk_timur_conn','rtk_timur_pln','rtk_timur_usonic','rtk_timur_gage_1','rtk_timur_gage_2','rtk_timur_gage_3','rtk_timur_gage_4')
pumpParameter(apiPrasasti1,intervalAPI,'prasasti_conn','prasasti_pln','prasasti_usonic','prasasti_gage_1','prasasti_gage_2','prasasti_gage_3','prasasti_gage_4')
pumpParameter(apiCy1_1,intervalAPI,'cy1_conn','cy1_pln','cy1_usonic','cy1_gage_1','cy1_gage_2','cy1_gage_3','cy1_gage_4')
pumpParameter(apiCy2,intervalAPI,'cy2_conn','cy2_pln','cy2_usonic','cy2_gage_1','cy2_gage_2','cy2_gage_3','cy2_gage_4')
pumpParameter(apiCy4,intervalAPI,'cy4_conn','cy4_pln','cy4_usonic','cy4_gage_1','cy4_gage_2','cy4_gage_3','cy4_gage_4')
pumpParameter(apiCluster2_1,intervalAPI,'cluster2_conn','cluster2_pln','cluster2_usonic','cluster2_gage_1','cluster2_gage_2','cluster2_gage_3','cluster2_gage_4')


tideBahaya='<?php json_encode($viewBahaya); ?>'
tideWaspada='<?php json_encode($viewWaspada); ?>'
tideAman='<?php json_encode($viewAman); ?>'
pasutmlws(apiPrasasti2,tideBahaya,tideWaspada,tideAman)

// _______________ Initialize TOOLTIP _______________ 
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    </script>
  </body>
</html>
