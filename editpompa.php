<?php
require_once("orc_conn.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Update Data Pompa</title>
		<link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
		<script src="dist/bootstrap/bootstrap.bundle.min.js"></script>
		<script src="dist/jquery/jquery-3.7.1.min.js"></script>
		<script>
			function popupmodal(textcontent){
				new bootstrap.Modal(document.getElementById('popupmodal')).show()
				document.getElementById('popupcontent').innerHTML=textcontent
			}
			function redirect(){
				document.location='daftarpompa.php';
			}
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
		<!-- Modal NOTIFICATION -->
		<div class="modal fade" id="popupmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body fw-semibold fs-5" id="popupcontent"><!-- Modal content text --></div>
							<div class="modal-footer align-middle ">
								<button type="button" class="btn btn-outline-info" data-bs-dismiss="modal" onclick="">
									<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
									<path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
									</svg>
								OK</button>
							</div>
						</div>
					</div>
				</div><!-- End of Modal NOTIFICATION -->
<?php


/* SHOW EDIT DATA ----------------- */
if (isset($_POST['editpompa'],$_POST['idedit'])){
	$sqleditpompa="SELECT * FROM TB_POMPA WHERE NOMOR='$_POST[idedit]'";
	$data=oci_parse($conn,$sqleditpompa);
    oci_execute($data);
	$row=oci_fetch_array($data);
	// if($row['tgl_beli']==""){$tglbeli="2000-01-01";}
	// else{}
    $nomorid=$row['NOMOR'];
	$idpompa=$row['ID_POMPA'];
	$lokasi=$row['LOKASI_POMPA'];
	$sn=$row['SN_POMPA'];
	$merk=$row['MERK_POMPA'];
	$vdaya=$row['DAYA_POMPA'];
	$daya=number_format($vdaya, 1);
	
	$dateTime = DateTime::createFromFormat('d-M-y',$row['TGL_BELI']);
	$tglbeli = $dateTime->format('Y-m-d');

	$vendor=$row['VENDOR'];
	$vhead=$row['HEADMAX'];
	$head=number_format($vhead, 1);
	$vkapasitas=$row['KAPASITAS'];
	$kapasitas=number_format($vkapasitas, 1);
	$vdiameter=$row['DIAMETER_PIPA'];
	$diameter=number_format($vdiameter, 1);
	$tipe=$row['TIPE_POMPA'];
	$pln=$row['LISTRIK_PLN'];
	$genset=$row['LISTRIK_GENSET'];
	$catchment=$row['CATCHMENT'];
	$garansi=$row['GARANSI'];
	$file=$row['FILE_DOC'];
    
?>

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

		<div class="container-sm w-75" style="">
			<!-- **************************** FORM SECTION -->
			<div class="card">
				<div class="card-header p-3 fs-4 fw-bold text-center">UPDATE DATA POMPA BANJIR<br>PELABUHAN TANJUNG EMAS SEMARANG</div>
				<div class="card-body">
					<!-- was-validated -->
					<form class="needs-validation" novalidate action="actionform.php" target="_SELF" method="POST" autocomplete="on" id="" enctype="multipart/form-data">
						<!-- <div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15rem;">Nama Pompa</span>
							<input type="text" maxlength="20" class="form-control" placeholder="Nama Pompa" name="namapompa" id="namapompa" required>
							<div class="invalid-tooltip">Nama pompa harus diisi !</div>
						</div> -->
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">ID Pompa</span>
							<input type="text" maxlength="20" class="form-control" placeholder="ID Pompa" value="<?= $idpompa; ?>" name="idpompa" id="idpompa" disabled readonly>
							<div class="invalid-tooltip">ID pompa harus diisi !</div>
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Lokasi Pompa</span>
							<input type="text" maxlength="60" class="form-control" placeholder="Lokasi Pompa" value="<?= $lokasi; ?>" name="lokasipompa" id="lokasipompa" required>
							<div class="invalid-tooltip">Lokasi pompa harus diisi !</div>
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Merk</span>
							<input type="text" maxlength="20" class="form-control" placeholder="Merk" value="<?= $merk; ?>" name="merk" id="merk" required>
							<div class="invalid-tooltip">Merk pompa harus diisi !</div>
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Serial Number</span>
							<input type="text" maxlength="20" class="form-control" placeholder="Serial Number" value="<?= $sn; ?>" name="sn" id="sn" >
							<div class="invalid-tooltip">Serial number pompa harus diisi !</div>
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Daya Pompa</span>
							<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Daya Pompa" value="<?= $daya; ?>" name="dayapompa" id="dayapompa">
							<span class="input-group-text" style="width:6em;">kW</span>
							<div class="invalid-tooltip">Daya pompa harus diisi dengan format angka !</div>
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Tanggal Pembelian<?= $tglbeli; ?></span>
							<input type="date" class="form-control" value="<?= $tglbeli; ?>" name="tglbeli" id="tglbeli">
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Vendor</span>
							<input type="text" maxlength="20" class="form-control" placeholder="Vendor" value="<?= $vendor; ?>" name="vendor" id="vendor">
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Head Max</span>
							<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Head" value="<?= $head; ?>" name="head" id="head">
							<span class="input-group-text" style="width:6em;">meter</span>
							<div class="invalid-tooltip">Head Max harus diisi dengan format angka !</div>
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Kapasitas</span>
							<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Kapasitas" value="<?= $kapasitas; ?>" name="kapasitas" id="kapasitas">
							<span class="input-group-text" style="width:6em;">liter/detik</span>
							<div class="invalid-tooltip">Kapasitas harus diisi dengan format angka !</div>
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Diameter Pipa</span>
							<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Diameter Pipa" value="<?= $diameter; ?>" name="diameterpipa" id="diameterpipa">
							<span class="input-group-text" style="width:6em;">inch</span>
							<div class="invalid-tooltip">Diameter Pipa harus diisi dengan format angka !</div>
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Tipe Pompa</span>
							<input type="text" maxlength="20" class="form-control" placeholder="Tipe Pompa" value="<?= $tipe; ?>" name="tipepompa" id="tipepompa">
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Sumber Listrik PLN</span>
							<input type="text" maxlength="10" class="form-control" placeholder="Sumber Listrik PLN" value="<?= $pln; ?>" name="sumberpln" id="sumberpln">
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Sumber Listrik Genset</span>
							<input type="text" maxlength="10" class="form-control" placeholder="Sumber Listrik Genset" value="<?= $genset; ?>" name="sumbergenset" id="sumbergenset">
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Catchment Area</span>
							<input type="text" maxlength="40" class="form-control" placeholder="Catchment Area" value="<?= $catchment; ?>" name="catchment" id="catchment">
						</div>
						<div class="input-group m-2">
							<span class="input-group-text fw-semibold" style="width:15em;">Garansi</span>
							<input type="text" maxlength="20" class="form-control" placeholder="Garansi" value="<?= $garansi; ?>" name="garansi" id="garansi">
						</div>
						<div class="input-group m-2">
							<label class="input-group-text fw-semibold" for="filedoc" style="width:15em;">Upload File Document</label>
							<input type="text" class="form-control" value="<?= $file; ?>" name="filedoc_edit" id="filedoc_edit" readonly>
							<input type="file" class="form-control is-invalid" name="filedoc" id="filedoc">
							<div class="invalid-feedback">Upload file PDF dengan ukuran maksimal 5MB !</div>
						</div>
							
						<div class="row justify-content-end">
							<div class="col align-self-start m-2">
								<a href="daftarpompa.php" class="btn btn-outline-secondary fs-5" type="button">
									<svg width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
									<path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
									<path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
									</svg>
									Cancel</a>
							</div>
							<div class="col-auto m-2">
								<input type="hidden" name="idno" id="idno" value="<?= $nomorid; ?>">
								<button class="btn btn-outline-success fs-5" type="submit" name="updatepompa" id="updatepompa">
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
<?php
oci_free_statement($data);

?><script>popupmodal("Data telah ditampilkan di form");</script><?php
}/* END of SHOW EDIT DATA ----------------- */

else{
	?><script>document.location='daftarpompa.php';</script><?php
}
?>

				

		<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
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

		
		</script>

	</body>
</html>