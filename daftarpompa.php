<?php
require_once("db_pompa_conn.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Daftar Pompa</title>
		<link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="dist/font/static">
		<script src="dist/bootstrap/bootstrap.bundle.min.js"></script>
		<script src="dist/jquery/jquery-3.7.1.min.js"></script>
		
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
								<a class="nav-link" href="https://pompa.pelindo.co.id"><img src="dist/x_dashboard.png"></a>
							</li>
						<div class="ms-3 me-3 vr"></div>
							<li class="nav-item"><!-- POMPA MENU -->
								<a class="nav-link" href="#"><img src="dist/x_pompa.png"></a>
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
									<li><a class="dropdown-item" href="#">Management User</a></li>
									<li><a class="dropdown-item" href="#">Management Pumpit</a></li>
								</ul>
							</li>
						<div class="ms-3 me-3 vr"></div>
							<li class="nav-item"><!-- USER MENU -->
								<a class="nav-link" href="#"><img src="dist/x_user.png"></a>User
							</li>
						<div class="ms-3 me-3 vr"></div>
							<li class="nav-item"><!-- LOGOUT MENU -->
								<a class="nav-link" href="https://pompa.pelindo.co.id"><img src="dist/x_logout.png"></a>Logout
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
							<th class="p-3 fs-4" colspan="19">DAFTAR POMPA BANJIR<br>PELABUHAN TANJUNG EMAS SEMARANG</th>
						</tr>
					</thead>
					<thead class="text-end addhead">
						<tr><td colspan="19" class=""><button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalinputdata">
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
$limit = 10;
$sqlpage = "SELECT COUNT(*) AS total_rows FROM tb_pompa";
$datpage = $conn->query($sqlpage);
$row = $datpage->fetch(PDO::FETCH_ASSOC);
$numrow = $row['total_rows'];

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$totalpages = ceil($numrow / $limit); // Pembulatan ke atas
$max_pagination_level = 11;
$gap_page = 5;

if ($page > $max_pagination_level - $gap_page) {
    $endpage = $page + $gap_page;
    $p = $endpage - 10;
}
if ($page <= $max_pagination_level - $gap_page) {
    $p = 1;
    $endpage = $max_pagination_level;
}
if ($totalpages < $max_pagination_level) {
    $endpage = $totalpages;
}
if ($page >= $totalpages - $gap_page) {
    $endpage = $totalpages;
    $p = $endpage - 10;
}
if ($p < 1) {
    $p = 1;
}

// Variable dari PAGINATION
$pageoffset = $page - 1;
$offset = $pageoffset * $limit;
$no = $offset + 1;

// Query untuk mengambil data dengan batasan halaman
$sql = "
SELECT * FROM (
    SELECT a.*, ROWNUM rnum 
    FROM (
        SELECT * FROM tb_pompa ORDER BY nomor DESC
    ) a 
    WHERE ROWNUM <= :offset + :limit
) 
WHERE rnum > :offset";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// TAMPIL DATA -----------------
$sqlpompa = "
SELECT * FROM (
    SELECT a.*, ROWNUM rnum 
    FROM (
        SELECT * 
        FROM tb_pompa 
        /* LEFT JOIN tb_maintenance ON tb_pompa.id_pompa = tb_maintenance.id_pompa */
        ORDER BY lokasi_pompa ASC
    ) a 
    WHERE ROWNUM <= :offset + :limit
) 
WHERE rnum > :offset";

$stmt = $conn->prepare($sqlpompa);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $nomorid = $row['nomor'];
    $idpompa = $row['id_pompa'];
    $lokasi = $row['lokasi_pompa'];
    $sn = $row['sn_pompa'];
    $merk = $row['merk_pompa'];
    $daya = $row['daya_pompa'];
    $tglbeli = $row['tgl_beli'];
    $vendor = $row['vendor'];
    $head = $row['headmax'];
    $kapasitas = $row['kapasitas'];
    $diameter = $row['diameter_pipa'];
    $tipe = $row['tipe_pompa'];
    $pln = $row['listrik_pln'];
    $genset = $row['listrik_genset'];
    $catchment = $row['catchment'];
    $garansi = $row['garansi'];
    // $tglmaintenance = $row['tanggal_maintenance'];
    // $jenismaintenance = $row['jenis_maintenance'];
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
							<td class="align-middle">
								<div class="d-flex justify-content-center">
									<div class="pe-2">
										<form method="post" action="editpompa.php" target="_self">
											<input type="hidden" name="idedit" value="<?=$nomorid; ?>">
											<button type="submit" name="editpompa" value="Edit" class="btn btn-sm btn-outline-primary fs-5">
												<svg width="23" height="23" fill="currentcolor" viewBox="0 0 16 16">
													<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
													<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
												</svg>
											</button>
										</form>
									</div>
									<div class="ps-2">
											<button type="submit" name="deletepompa" value="Delete" class="btn btn-sm btn-outline-danger fs-5" data-bs-toggle="modal" data-bs-target="#popupmodaldelete" onclick="$('#popupmodaldelete #formdelete #iddelete').attr({'name':'iddelete','value':'<?= $nomorid ?>'})">
												<svg width="23" height="23" fill="currentcolor" viewBox="0 0 16 16">
													<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
													<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
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
							<form class="needs-validation" novalidate action="actionform.php" target="_SELF" method="POST" autocomplete="on" id="formtambahpompa">
								<!-- <div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15rem;">Nama Pompa</span>
									<input type="text" maxlength="20" class="form-control" placeholder="Nama Pompa" name="namapompa" id="namapompa" required>
									<div class="invalid-tooltip">Nama pompa harus diisi !</div>
								</div> -->
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">ID Pompa</span>
									<input type="text" maxlength="20" class="form-control" placeholder="ID Pompa" name="idpompa" id="idpompa" required>
									<div class="invalid-tooltip">ID pompa harus diisi !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Lokasi Pompa</span>
									<input type="text" maxlength="60" class="form-control" placeholder="Lokasi Pompa" name="lokasipompa" id="lokasipompa" required>
									<div class="invalid-tooltip">Lokasi pompa harus diisi !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Merk</span>
									<input type="text" maxlength="20" class="form-control" placeholder="Merk" name="merk" id="merk" required>
									<div class="invalid-tooltip">Merk pompa harus diisi !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Serial Number</span>
									<input type="text" maxlength="20" class="form-control" placeholder="Serial Number" name="sn" id="sn" >
									<div class="invalid-tooltip">Serial number pompa harus diisi !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Daya Pompa</span>
									<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Daya Pompa" value="0" name="dayapompa" id="dayapompa">
									<span class="input-group-text" style="width:6em;">kW</span>
									<div class="invalid-tooltip">Daya pompa harus diisi dengan format angka !</div>
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
									<div class="invalid-tooltip">Head Max harus diisi dengan format angka !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Kapasitas</span>
									<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Kapasitas" value="0" name="kapasitas" id="kapasitas">
									<span class="input-group-text" style="width:6em;">liter/detik</span>
									<div class="invalid-tooltip">Kapasitas harus diisi dengan format angka !</div>
								</div>
								<div class="input-group m-2">
									<span class="input-group-text fw-semibold" style="width:15em;">Diameter Pipa</span>
									<input type="number" class="form-control" min="0" max="999999" step="0.1" placeholder="Diameter Pipa" value="0" name="diameterpipa" id="diameterpipa">
									<span class="input-group-text" style="width:6em;">inch</span>
									<div class="invalid-tooltip">Diameter Pipa harus diisi dengan format angka !</div>
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
									<input type="file" class="form-control" name="filedoc" id="filedoc" >
								</div>
								<div class="" style="">
									<!-- <div class="" style=""></div> data-bs-dismiss="modal"-->
									<div class="row justify-content-end">
										<div class="col-sm-8 m-2">
											<button class="btn btn-outline-secondary fw-semibold fs-5" type="button" onclick="popupmodalconfirm('Apakah yakin akan keluar?')">
												<svg width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
												<path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
												<path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
												</svg>
												Cancel</button>
										</div>
										<div class="col-auto btn-group m-2">
											<button class="btn btn-outline-danger fw-semibold fs-5" type="reset">
												<svg width="17" height="17" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">
												<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
												<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
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
									<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
									</svg>
								Tidak</button>
								<form method="post" target="_self" id="" action="">
								<input type="hidden" name="" id="" value="">
								<button type="submit" name="" id="" class="btn btn-outline-danger">
									<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
									<path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
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
							<div class="modal-body fw-semibold fs-5" id="deletecontent">Yakin akan menghapus data ini ?</div>
							<div class="modal-footer ">
								<button type="button" class="btn btn-outline-dark align-middle" data-bs-dismiss="modal">
									<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
									</svg>
								Tidak</button>
								<form method="post" target="_self" id="formdelete" action="">
								<input type="hidden" name="iddelete" id="iddelete" value="">
								<button type="submit" name="absolutelydelete" id="absolutelydelete" class="btn btn-outline-danger">
									<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
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
if (isset($_POST['iddelete'])) {
    $sqldelete = "DELETE FROM tb_pompa WHERE nomor = :iddelete";
    $stmt = $conn->prepare($sqldelete);

    try {
        // Bind parameter
        $stmt->bindParam(':iddelete', $_POST['iddelete'], PDO::PARAM_STR);

        // Eksekusi query
        if ($stmt->execute()) {
            ?>
            <script>popupmodal("Data telah berhasil dihapus!")</script>
            <?php
        } else {
            ?>
            <script>popupmodal("Data gagal dihapus!")</script>
            <?php
        }
    } catch (PDOException $e) {
        ?>
        <script>popupmodal("Terjadi kesalahan: <?= $e->getMessage(); ?>")</script>
        <?php
    }
}
/* END of HAPUS DATA ----------------- */

// Tutup koneksi
$conn = null;
?>