<?php
require_once("orc_conn.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Daftar Pompa</title>
		<link rel="icon" type="image/x-icon" href="dist/favicon.png">
		<link rel="stylesheet" href="dist/font/static">
		<link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
		<script type="text/javascript" src="dist/bootstrap/bootstrap.bundle.min.js"></script>
		<script type="text/javascript" src="dist/jquery/jquery-3.7.1.min.js"></script>
		
		<style>
			/* NAVBAR DEPENDENCY */
			.nav-item:hover{filter:invert(90%);z-index:9;}
			.nav-item{transition: all .3s linear;}
			.dropdown:hover .dropdown-menu{display: block;margin-top: 0;}
			.dropdown .dropdown-menu{display: none;}

			.firsthead .addhead, tr,td,th {border: none;}
			.secondhead th {
				background: #01afff;
				color: azure;
				border: 1px solid #ccc;
			}
			.childtable td {
				border: 1px solid #ccc;
				/* font-family: Verdana, sans-serif; */
			}
			
			table{
				
			}
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
									<li><a class="dropdown-item" href="#">Report Pumppit</a></li>
									<li><a class="dropdown-item" href="#">Report Pasut</a></li>
								</ul>
							</li>
						<div class="ms-3 me-3 vr"></div>
							<li class="nav-item dropdown"><!-- MANAGEMENT MENU -->
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="dist/x_management.png"></a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="usermgmt.php">Management User</a></li>
									<li><a class="dropdown-item" href="#">Management Pumppit</a></li>
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

		<div class="container-fluid">
			<!-- **************************** TABEL SECTION -->
				<table class="table table-sm table-hover table-bordered">
					<thead class="text-center align-middle firsthead" style="">
						<tr>
							<th class="p-3 fs-4" colspan="20">DAFTAR POMPA BANJIR<br>PELABUHAN TANJUNG EMAS SEMARANG</th>
						</tr>
					</thead>
					<thead class="text-end addhead">
						<tr><td colspan="20" class=""><button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalinputdata">
						<svg width="30" height="30" fill="currentcolor" viewBox="0 0 512 512">
							<path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
						</svg>
						TAMBAH POMPA</button></td></tr>
					</thead>
					<thead class="text-center align-middle secondhead fs-6">
						<tr>
							<th rowspan="2">No</th>
							<th rowspan="2">ID<br>Pompa</th>
							<th rowspan="2">Lokasi</th>
							<th rowspan="2">Merk</th>
							<th rowspan="2">Serial<br>Number</th>
							<th rowspan="2">Daya</th>
							<th rowspan="2">Tgl<br>Pembelian</th>
							<th rowspan="2">Vendor</th>
							<th rowspan="2">Head<br>Max</th>
							<th rowspan="2">Kapasitas</th>
							<th rowspan="2">Diameter<br>Pipa</th>
							<th rowspan="2">Tipe<br>Pompa</th>
							<th colspan="2">Sumber Listrik</th>
							<th rowspan="2">Catchment<br>Area</th>
							<th rowspan="2">Garansi</th>
							<th rowspan="2">Terakhir<br>Maintenance</th>
							<th rowspan="2">Jenis<br>Maintenance</th>
							<th rowspan="2">
								<svg width="24" height="24" fill="currentColor"viewBox="0 0 512 512" >
								<path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>	
							</svg>
							</th>
							<th rowspan="2">Aksi</th>
						</tr>
						<tr>
							<th>PLN</th>
							<th>Genset</th>
						</tr>
					</thead>
					<tbody class="childtable align-middle fs-6">
	<?php
	// PAGINATION DATA
	$limit=10;
	$sqlpage="SELECT COUNT(*) AS TOTAL_ROWS FROM TB_POMPA";
	$datpage=oci_parse($conn,$sqlpage);
    oci_execute($datpage);
	$rowpg=oci_fetch_array($datpage);
	$numrow=$rowpg['TOTAL_ROWS'];

	if (isset($_GET["page"])){$page=$_GET["page"];}
	else {$page=1;}
	$totalpages=ceil($numrow/$limit);                     //Pembulatan keatas
	$max_pagination_level=11;
	$gap_page=5;
	if($page>$max_pagination_level-$gap_page){
		$endpage=$page+$gap_page;
		$p=$endpage-10;
	}
	if($page<=$max_pagination_level-$gap_page){
		$p=1; 
		$endpage=$max_pagination_level;
	}
	if($totalpages<$max_pagination_level){$endpage=$totalpages;}
	if($page>=$totalpages-$gap_page){$endpage=$totalpages; $p=$endpage-10;}
	if($p<1){$p=1;}
	//variable dari PAGINATION
	$pageoffset=$page-1;
	$offset=$pageoffset*$limit;
	$no=$offset+1;

	/* TAMPIL DATA ----------------- */
	$sqlpompa="SELECT * FROM TB_POMPA ORDER BY NOMOR ASC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	$data=oci_parse($conn,$sqlpompa);
    oci_execute($data);
	while (($row=oci_fetch_array($data))==true){
		$nomorid=$row['NOMOR'];
		$idpompa=$row['ID_POMPA'];
		$lokasi=$row['LOKASI_POMPA'];
		$sn=$row['SN_POMPA'];
		$merk=$row['MERK_POMPA'];
		$vdaya=$row['DAYA_POMPA'];
		$daya=number_format($vdaya ?? 0, 2);
		$tglbeli=$row['TGL_BELI'];
		$vendor=$row['VENDOR'];
		$vhead=$row['HEADMAX'];
		$head=number_format($vhead ?? 0, 2);
		$vkapasitas=$row['KAPASITAS'];
		$kapasitas=number_format($vkapasitas ?? 0, 2);
		$vdiameter=$row['DIAMETER_PIPA'];
		$diameter=number_format($vdiameter ?? 0, 2);
		$tipe=$row['TIPE_POMPA'];
		$pln=$row['LISTRIK_PLN'];
		$genset=$row['LISTRIK_GENSET'];
		$catchment=$row['CATCHMENT'];
		$garansi=$row['GARANSI'];
		$file=$row['FILE_DOC'];
		if($file!=null){
			$file="<a href='download.php?file=".$file."'>File</a>";
		}
		
		// $tglmaintenance=$row['tanggal_maintenance'];
		// $jenismaintenance=$row['jenis_maintenance'];
    ?>
						<tr>
							<td class="text-center"><?= $no; ?></td>
							<td><?= $idpompa; ?></td>
							<td><?= $lokasi; ?></td>
							<td><?= $merk; ?></td>
							<td><?= $sn; ?></td>
							<td><?= $daya; ?></td>
							<td><?= $tglbeli; ?></td>
							<td><?= $vendor; ?></td>
							<td><?= $head; ?></td>
							<td><?= $kapasitas; ?></td>
							<td><?= $diameter; ?></td>
							<td><?= $tipe; ?></td>
							<td><?= $pln; ?></td>
							<td><?= $genset; ?></td>
							<td><?= $catchment; ?></td>
							<td><?= $garansi; ?></td>
							<td><? // $tglmaintenance; ?></td>
							<td><? // $jenismaintenance; ?></td>
							<td class="text-center"><?= $file; ?></td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">
									<div class="pe-2">
										<form method="post" action="editpompa.php" target="_self">
											<input type="hidden" name="idedit" value="<?=$nomorid; ?>">
											<button type="submit" name="editpompa" value="Edit" class="btn btn-sm btn-outline-primary fs-5">
												<svg width="23" height="23" fill="currentcolor" viewBox="0 0 512 512">
													<path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
												</svg>
											</button>
										</form>
									</div>
									<div class="ps-2">
										<button type="submit" name="deletepompa" value="Delete" class="btn btn-sm btn-outline-danger fs-5" data-bs-toggle="modal" data-bs-target="#popupmodaldelete" onclick="$('#popupmodaldelete #formdelete #iddelete').attr({'name':'iddelete','value':'<?= $nomorid ?>'})">
											<svg width="23" height="23" fill="currentColor" viewBox="0 0 448 512">
												<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
											</svg>
										</button>
									</div>
								</div>
							</td>
						</tr>
		<?php
        $no++;
        }// END of While Looping
	
        ?> 
					</tbody>
				</table>
				<nav>
				<ul class="pagination justify-content-center">
					<li class="page-item <?php if($page==1){echo "disabled";}?>"><a class="page-link" href="?page=<?php echo $page-1;?>">Previous Page</a></li>
					<?php
					while($p<=$endpage){
						?><li class="page-item <?php if($p==$page){echo "active";}?>"><a class="page-link" href="?page=<?php echo $p;?>"><?php echo $p;?></a></li><?php
						$p++;
					}
					?>
					<li class="page-item <?php if($page==$totalpages){echo "disabled";}?>"><a class="page-link" href="?page=<?php echo $page+1;?>">Next Page</a></li>
				</ul>
				</nav>

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

				<!-- Modal FORM TAMBAH POMPA -->
				<div class="modal fade" id="modalinputdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
					<div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down modal-xl">
						<div class="modal-content">
							<div class="modal-body text-center fw-bold fs-4">INPUT DATA POMPA BANJIR PELABUHAN TANJUNG EMAS SEMARANG</div>
							<div class="modal-body fw-semibold fs-5">
							<form class="needs-validation" novalidate action="actionform.php" target="_SELF" method="POST" autocomplete="on" id="formtambahpompa" enctype="multipart/form-data">
								<!-- <div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15rem;">Nama Pompa</span>
									<input type="text" maxlength="20" class="form-control" placeholder="Nama Pompa" name="namapompa" id="namapompa" required>
									<div class="invalid-tooltip">Nama pompa harus diisi !</div>
								</div> -->
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">ID Pompa</span>
									<input type="text" maxlength="20" class="form-control" placeholder="ID Pompa" name="idpompa" id="idpompa" required>
									<div class="invalid-tooltip" style="top:5%;">ID Pompa harus diisi !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Lokasi Pompa</span>
									<input type="text" maxlength="60" class="form-control" placeholder="Lokasi Pompa" name="lokasipompa" id="lokasipompa" required>
									<div class="invalid-tooltip" style="top:5%;">Lokasi Pompa harus diisi !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Merk Pompa</span>
									<input type="text" maxlength="20" class="form-control" placeholder="Merk Pompa" name="merk" id="merk" required>
									<div class="invalid-tooltip" style="top:5%;">Merk Pompa harus diisi !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Serial Number</span>
									<input type="text" maxlength="20" class="form-control" placeholder="Serial Number" name="sn" id="sn" >
									<div class="invalid-tooltip" style="top:5%;">SN Pompa harus diisi !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Daya Pompa</span>
									<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Daya Pompa" value="0" name="dayapompa" id="dayapompa">
									<span class="input-group-text" style="width:6em;">kW</span>
									<div class="invalid-tooltip" style="top:5%;">Daya Pompa harus format angka !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Tanggal Pembelian</span>
									<input type="date" class="form-control" name="tglbeli" id="tglbeli">
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Vendor</span>
									<input type="text" maxlength="20" class="form-control" placeholder="Vendor" name="vendor" id="vendor">
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Head Max</span>
									<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Head" value="0" name="head" id="head">
									<span class="input-group-text" style="width:6em;">meter</span>
									<div class="invalid-tooltip" style="top:5%;">Head Max harus format angka !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Kapasitas</span>
									<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Kapasitas" value="0" name="kapasitas" id="kapasitas">
									<span class="input-group-text" style="width:6em;">liter/detik</span>
									<div class="invalid-tooltip" style="top:5%;">Kapasitas harus format angka !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Diameter Pipa</span>
									<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Diameter Pipa" value="0" name="diameterpipa" id="diameterpipa">
									<span class="input-group-text" style="width:6em;">inch</span>
									<div class="invalid-tooltip" style="top:5%;">Diameter Pipa harus format angka !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Tipe Pompa</span>
									<input type="text" maxlength="20" class="form-control" placeholder="Tipe Pompa" name="tipepompa" id="tipepompa">
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Sumber Listrik PLN</span>
									<input type="text" maxlength="10" class="form-control" placeholder="Sumber Listrik PLN" name="sumberpln" id="sumberpln">
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Sumber Listrik Genset</span>
									<input type="text" maxlength="10" class="form-control" placeholder="Sumber Listrik Genset" name="sumbergenset" id="sumbergenset">
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Catchment Area</span>
									<input type="text" maxlength="40" class="form-control" placeholder="Catchment Area" name="catchment" id="catchment">
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Garansi</span>
									<input type="text" maxlength="20" class="form-control" placeholder="Garansi" name="garansi" id="garansi">
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Terakhir Maintenance</span>
									<input type="date" class="form-control" name="terakhirmaintenance" id="terakhirmaintenance">
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Jenis Maintenance</span>
									<input type="text" maxlength="60" class="form-control" placeholder="Jenis Maintenance" name="jenismaintenance" id="jenismaintenance">
								</div>
								<div class="input-group m-2">
									<label class="input-group-text fw-semibold" for="filedoc" style="width:15em;">Upload File Document</label>
									<input type="file" class="form-control is-invalid" name="filedoc" id="filedoc" >
									<div class="invalid-feedback">Upload file PDF dengan ukuran maksimal 5MB !</div>
								</div>
								
								<div class="row justify-content-end">
									<div class="col align-self-start m-2">
										<button class="btn btn-outline-secondary fw-semibold fs-5" type="button" onclick="popupmodalconfirm('Apakah yakin akan keluar?')">
											<svg width="19" height="19" fill="currentColor" viewBox="0 0 576 512">
												<path d="M576 128c0-35.3-28.7-64-64-64L205.3 64c-17 0-33.3 6.7-45.3 18.7L9.4 233.4c-6 6-9.4 14.1-9.4 22.6s3.4 16.6 9.4 22.6L160 429.3c12 12 28.3 18.7 45.3 18.7L512 448c35.3 0 64-28.7 64-64l0-256zM271 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/>
											</svg>
											Cancel</button>
									</div>
									<div class="col-auto btn-group m-2">
										<button class="btn btn-outline-danger fw-semibold fs-5" type="reset">
											<svg width="17" height="17" fill="currentColor" viewBox="0 0 512 512">
												<path d="M64 80c-8.8 0-16 7.2-16 16l0 320c0 8.8 7.2 16 16 16l384 0c8.8 0 16-7.2 16-16l0-320c0-8.8-7.2-16-16-16L64 80zM0 96C0 60.7 28.7 32 64 32l384 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zm175 79c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/>
											</svg>
											Clear</button>
										<button class="btn btn-outline-success fw-semibold fs-5" type="submit" name="tambahpompa" id="submit">
											<svg width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
											<path d="M11 2H9v3h2z"/>
											<path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
											</svg>
											Simpan Data</button>	
									</div>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div><!-- End of Modal FORM TAMBAH POMPA -->

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

				<!-- Modal CONFIRM DELETE -->
				<div class="modal fade" id="popupmodaldelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
					<div class="modal-dialog modal-dialog-centered modal-sm">
						<div class="modal-content">
							<div class="modal-body fw-semibold fs-5" id="deletecontent">Yakin akan menghapus seluruh data pompa ini ?</div>
							<div class="modal-footer ">
								<button type="button" class="btn btn-outline-dark align-middle" data-bs-dismiss="modal">
									<svg width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
										<path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
									</svg>
								Tidak</button>
								<form method="post" target="_self" id="formdelete" action="">
								<input type="hidden" name="iddelete" id="iddelete" >
								<button type="submit" name="absolutelydelete" id="absolutelydelete" class="btn btn-outline-danger">
									<svg width="16" height="16" fill="currentColor" viewBox="0 0 448 512">
										<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
									</svg>
								Hapus</button>
								</form>
							</div>
						</div>
					</div>
				</div><!-- End of Modal CONFIRM DELETE -->

			</div>
		
		<script>


			// _______________ disabling form submissions if there are empty or invalid fields _______________
(() => {
'use strict'
// Fetch all the forms we want to apply custom Bootstrap validation styles to
const forms = document.querySelectorAll('.needs-validation')
	// Loop over them and prevent submission
	Array.from(forms).forEach(form => {
		form.addEventListener('submit', event => {
			if(!form.checkValidity()){
				event.preventDefault();event.stopPropagation()
			}
			form.classList.add('was-validated')
		}, false)
	})
})()

function popupmodalconfirm(textcontent){
    new bootstrap.Modal(document.getElementById('popupmodalconfirm')).show()
    document.getElementById('contentconfirm').innerHTML=textcontent
}
function popupmodaldelete(textcontent){
    new bootstrap.Modal(document.getElementById('popupmodaldelete')).show()
    document.getElementById('deletecontent').innerHTML=textcontent
}
function popupmodal(textcontent){
    new bootstrap.Modal(document.getElementById('popupmodal')).show()
    document.getElementById('popupcontent').innerHTML=textcontent
}
function redirect(){
    document.location='daftarpompa.php';
}

			// _______________ Initialize TOOLTIP _______________ 
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
		</script>
	</body>
</html>
<?php
/* HAPUS DATA ----------------- */
if(isset($_POST['iddelete'])){
	$queryselect="SELECT * FROM TB_POMPA WHERE NOMOR='$_POST[iddelete]'";
	$dat=oci_parse($conn,$queryselect);
    oci_execute($dat);
    $rw=oci_fetch_array($dat);

    $nmeid=$rw['ID_POMPA'];
    $filedoc=$rw['FILE_DOC'];
	$target_file='file_documents_pompa/'.$filedoc;

	$sqldelete="DELETE FROM TB_POMPA WHERE NOMOR= :nomor";
    $parsedel=oci_parse($conn,$sqldelete);
	oci_bind_by_name($parsedel, ':nomor', $_POST['iddelete']);
	
	if(oci_execute($parsedel)){
		if(oci_num_rows($parsedel)>0){
			oci_commit($conn);
			if(file_exists($target_file) && $filedoc!=null){
				unlink($target_file);
			}
			?><script>popupmodal("Semua data dengan id pompa '<?=$nmeid;?>' berhasil dihapus.")</script><?php
		}
		else { ?><script>popupmodal("Data gagal dihapus !")</script><?php }
	}
	else { ?><script>popupmodal("Data gagal dihapus !")</script><?php }
	oci_free_statement($dat);
	oci_free_statement($parsedel);
}/* END of HAPUS DATA ----------------- */

oci_free_statement($datpage);
oci_free_statement($data);

oci_close($conn);
?>