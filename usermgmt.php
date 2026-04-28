<?php
require_once("orc_conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User Pompa</title>
    <link rel="icon" type="image/x-icon" href="dist/favicon.png">
    <link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
    <script type="text/javascript" src="dist/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="dist/jquery/jquery-3.7.1.min.js"></script>
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

        <div class="container-md w-50">
            <div class="card">
                <div class="card-header p-3 fs-4 fw-bold text-center">MANAJEMEN USER POMPA BANJIR<br>PELABUHAN TANJUNG EMAS SEMARANG</div>
                <div class="card-body">
                    <div class="row justify-content-end pb-2">
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalinputuser">
                            <svg width="30" height="30" fill="currentcolor" viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                            </svg>
                            TAMBAH USER</button>
                        </div>
                    </div>
                    <table class="table table-sm table-hover" style="font-family: Montserrat, serif;">
                    <thead class=" align-middle fs-6 ">
						<tr class="table-info">
							<th >#</th>
							<th >Nama Lengkap</th>
							<th >Username</th>
							<th >Jabatan</th>
							<th >Divisi</th>
							<th >Role User</th>
                            <th class="text-center">
                            <svg width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 512 512">
                            <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1 0 32c0 8.8 7.2 16 16 16l32 0zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/>
                            </svg>
                            </th>
							<th class="text-center">
                                <svg xmlns="" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </th>
						</tr>
                    </thead>
                    <!-- <tbody class="table-group-divider"> -->
                    <tbody class="align-middle fs-6">
<?php
$no=1;
$sqluser="SELECT * FROM USERS";
$data=oci_parse($conn,$sqluser);
oci_execute($data);
while ($row=oci_fetch_array($data)){
    $nomorid=$row['NOMOR'];
    $rownama=$row['NAMA'];
    $rowuser=$row['USERNAME'];
    $rowjabatan=$row['JABATAN'];
    $rowdivisi=$row['DIVISI'];
    $rowrole=$row['ROLE'];
?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $rownama;?></td>
                            <td><?= $rowuser?></td>
                            <td><?= $rowjabatan?></td>
                            <td><?= $rowdivisi?></td>
                            <td><?= $rowrole?></td>
                            <td class="text-center"><?php ?>
								<form method="post" action="usermgmt_edit.php" target="_self">
								<input type="hidden" name="idedit" value="<?=$nomorid; ?>">
                                <button type="submit" name="edituser" class="btn btn-sm btn-outline-primary">
                                <svg width="16" height="16" fill="currentcolor" viewBox="0 0 512 512">
                                    <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                                </svg>
								</button>
                                </form>
                            </td>
                            <td class="text-center"><?php ?>
                                <button type="submit" name="deleteuser" value="Delete" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#popupmodaldelete" onclick="$('#popupmodaldelete #formdelete #iddelete').attr({'name':'iddelete','value':'<?= $nomorid ?>'})">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 448 512">
                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                                </svg>
								</button>
                            </td>
                        </tr>
                    </tbody>
<?php
        $no++;
    }// END of While Looping
oci_free_statement($data);
?>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal FORM TAMBAH USER -->
        <div class="modal fade" id="modalinputuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
                    <div class="modal-content">
                        <div class="modal-body text-center fw-bold fs-4">INPUT USER POMPA BANJIR PELABUHAN TANJUNG EMAS SEMARANG</div>
                        <div class="modal-body fw-semibold fs-5">
                        <form class="needs-validation" novalidate action="" target="_SELF" method="POST" autocomplete="on" id="formtambahuser">
                            <div class="input-group m-2">
                                <span class="input-group-text fw-semibold" style="width:15em;">Nama Lengkap</span>
                                <input type="text" maxlength="30" class="form-control" placeholder="Nama" name="nama" id="nama" required>
                                <div class="invalid-tooltip" style="top:5%;">Nama harus diisi !</div>
                            </div>
                            <div class="input-group m-2">
                                <span class="input-group-text fw-semibold" style="width:15em;">Username</span>
                                <input type="text" minlength="6" maxlength="30" class="form-control" placeholder="Username" name="username" id="username" required>
                                <div class="invalid-tooltip" style="top:5%;">Username harus minimal 6 karakter !</div>
                            </div>
                            <div class="input-group m-2">
                                <span class="input-group-text fw-semibold" style="width:15em;">Password</span>
                                <input type="password" minlength="6" maxlength="30" class="form-control" placeholder="Password" name="password" id="password" required>
                                <span class="input-group-text toggle-password" id="" style="cursor: pointer;" onclick="togglePass('password')">
                                    <svg xmlns="" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                    </svg>
                                </span>
                                <div class="invalid-tooltip" style="top:5%;">Password harus minimal 6 karakter !</div>
                            </div>
                            <div class="input-group m-2">
                                <span class="input-group-text fw-semibold" style="width:15em;">Jabatan</span>
                                <input type="text" maxlength="40" class="form-control" placeholder="Jabatan" name="jabatan" id="jabatan">
                            </div>
                            <div class="input-group m-2">
                                <span class="input-group-text fw-semibold" style="width:15em;">Divisi</span>
                                <input type="text" maxlength="40" class="form-control" placeholder="Divisi" name="divisi" id="divisi">
                            </div>
                            <div class="input-group m-2">
                                <label class="input-group-text fw-semibold" for="role" style="width:15em;">Role</label>
                                <select class="form-select" name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="teknik">Teknik</option>
                                    <option value="viewer" selected>Viewer</option>
                                </select>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col align-self-start m-2">
                                    <button class="btn btn-outline-secondary fw-semibold fs-5" type="button"  data-bs-dismiss="modal" onclick="//popupmodalconfirm('Apakah yakin akan keluar?')">
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
                                    <button class="btn btn-outline-success fw-semibold fs-5" type="submit" name="tambahuser" id="submit">
                                        <svg width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M11 2H9v3h2z"/>
                                        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                                        </svg>
                                        Tambah User</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
        </div><!-- End of Modal FORM TAMBAH USER -->

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

        <!-- Modal CONFIRM DELETE -->
		<div class="modal fade" id="popupmodaldelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
			<div class="modal-dialog modal-dialog-centered modal-sm">
				<div class="modal-content">
					<div class="modal-body fw-semibold fs-5" id="deletecontent">Yakin akan menghapus user ini ?</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-outline-dark align-middle" data-bs-dismiss="modal">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
							<path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
							</svg>
						Tidak</button>
						<form method="post" target="_self" id="formdelete" action="">
						<input type="hidden" name="iddelete" id="iddelete" >
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

        <!-- Modal FORM EDIT USER -->
		<div class="modal fade" id="popupmodaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
			<div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
				<div class="modal-content">
					<div class="modal-body text-center fw-bold fs-4">EDIT USER POMPA BANJIR PELABUHAN TANJUNG EMAS SEMARANG</div>
					<div class="modal-body fw-semibold fs-5">
                    <form class="needs-validation" novalidate action="" target="_SELF" method="POST" autocomplete="on" id="formtambahuser">
                        <div class="input-group m-2">
                            <span class="input-group-text fw-semibold" style="width:15em;">Nama</span>
                            <input type="text" class="form-control" name="nama_edit" id="nama_edit" value="<?php echo '';?>" disabled readonly>
                        </div>
                        <div class="input-group m-2">
                            <span class="input-group-text fw-semibold" style="width:15em;">Username</span>
                            <input type="text" maxlength="30" class="form-control" name="user_edit" id="user_edit" value="<?php echo '';?>" disabled readonly>
                        </div>
                        <div class="input-group m-2">
                            <span class="input-group-text fw-semibold" style="width:15em;">Password</span>
                            <input type="password" minlength="6" maxlength="30" class="form-control" placeholder="Password" name="pass_edit" id="pass_edit" required>
                            <span class="input-group-text toggle-password" id="" style="cursor: pointer;" onclick="togglePass('pass_edit')">
                                <svg xmlns="" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </span>
                            <div class="invalid-tooltip" style="top:5%;">Password harus minimal 6 karakter !</div>
                        </div>
                        <div class="input-group m-2">
                            <span class="input-group-text fw-semibold" style="width:15em;">Jabatan</span>
                            <input type="text" maxlength="40" class="form-control" placeholder="Jabatan" name="jabatan_edit" id="jabatan_edit">
                        </div>
                        <div class="input-group m-2">
                            <span class="input-group-text fw-semibold" style="width:15em;">Divisi</span>
                            <input type="text" maxlength="40" class="form-control" placeholder="Divisi" name="divisi_edit" id="divisi_edit">
                        </div>
                        <div class="input-group m-2">
                            <label class="input-group-text fw-semibold" for="role" style="width:15em;">Role</label>
                            <select class="form-select" name="role_edit" id="role_edit">
                                <option value="admin">Admin</option>
                                <option value="teknik">Teknik</option>
                                <option value="viewer" selected>Viewer</option>
                            </select>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col align-self-start m-2">
								<button class="btn btn-outline-secondary fw-semibold fs-5" type="button" data-bs-dismiss="modal" onclick="//popupmodalconfirm('Apakah yakin akan keluar?')">
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
                                <button class="btn btn-outline-success fw-semibold fs-5" type="submit" name="simpanedituser" id="submit">
                                    <svg width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11 2H9v3h2z"/>
                                    <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                                    </svg>
                                    Update User</button>
                            </div>
                        </div>
                    </form>
					</div>
				</div>
			</div>
		</div><!-- End of Modal FORM EDIT USER -->

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

    function togglePass(xid){
        let idpass=document.getElementById(xid).type
        if(idpass=="password"){
            document.getElementById(xid).type="text"
        }
        else{
            document.getElementById(xid).type="password"
        }
    }

    // const togglePassword = document.getElementById('togglePassword');
    // const passwordInput = document.getElementById('password');
    // const eyeIcon = document.getElementById('eyeIcon');
    // togglePassword.addEventListener('click', function () {
    //     // Toggle the type attribute
    //     const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    //     passwordInput.setAttribute('type', type);
    //     // Toggle the eye icon
    //     // eyeIcon.classList.toggle('fa-eye');
    //     // eyeIcon.classList.toggle('fa-eye-slash');
    // });

    function popupmodal(textcontent){
        new bootstrap.Modal(document.getElementById('popupmodal')).show()
        document.getElementById('popupcontent').innerHTML=textcontent
    }
    function popupmodalconfirm(textcontent){
        new bootstrap.Modal(document.getElementById('popupmodalconfirm')).show()
        document.getElementById('contentconfirm').innerHTML=textcontent
    }
    function redirect(){
        document.location='usermgmt.php';
    }
    </script>
</body>
</html>
<?php
/* TAMBAH USER ----------------- */
if(isset($_POST['tambahuser'])){

    if(($_POST['username']!="" && $_POST['password']!="" && $_POST['nama']!="" && $_POST['role']!="")){
        $sqlusersel="SELECT COUNT(*) AS TOTAL_ROWS FROM USERS WHERE USERNAME='$_POST[username]'";
        $data=oci_parse($conn,$sqlusersel);
        oci_execute($data);
        $row=oci_fetch_array($data);
        $numrow=$row['TOTAL_ROWS'];
        if($numrow>0){                                                //cek data agar tidak ada double input
            ?><script>popupmodal("Data Username tersebut ganda, sudah ada di database sebelumnya !");</script><?php
        }
        else{
            // $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);    //ENKRIPSI PASSWORD
            $sqltambahuser="INSERT INTO USERS (NAMA,JABATAN,DIVISI,ROLE,USERNAME,PASSWORD) VALUES (:nam,:jabat,:div,:rol,:usern,:passw)";
            $datausr=oci_parse($conn,$sqltambahuser);
	        oci_bind_by_name($datausr, ':nam', $_POST['nama']);
            oci_bind_by_name($datausr, ':jabat', $_POST['jabatan']);
            oci_bind_by_name($datausr, ':div', $_POST['divisi']);
            oci_bind_by_name($datausr, ':rol', $_POST['role']);
            oci_bind_by_name($datausr, ':usern', $_POST['username']);
            oci_bind_by_name($datausr, ':passw', $_POST['password']);
            if(oci_execute($datausr)){
                ?><script>popupmodal("User telah berhasil ditambahkan")</script><?php
            }
            else { ?><script>popupmodal("Terjadi kesalahan. User gagal ditambahkan")</script><?php }
            
        }
    }
    else{
        ?><script>popupmodal("Data pada kolom masih kosong, harus diisi !");</script><?php
    }
oci_free_statement($data);
oci_free_statement($datausr);
}/* END of TAMBAH USER ----------------- */

/* HAPUS DATA ----------------- */
if(isset($_POST['iddelete'])){
	$sqldelete="DELETE FROM USERS WHERE NOMOR='$_POST[iddelete]'";
    $parsedel=oci_parse($conn,$sqldelete);
    oci_execute($parsedel);

	if (oci_execute($parsedel) == TRUE) {
		?><script>popupmodal("User telah berhasil dihapus !")</script><?php
	} else {
		?><script>popupmodal("User gagal dihapus !")</script><?php
	}
oci_free_statement($parsedel);

}/* END of HAPUS DATA ----------------- */

oci_close($conn);
?>