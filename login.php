<html lang="en">
<head>
		<link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
		<script src="dist/bootstrap/bootstrap.bundle.min.js"></script>
		<script src="dist/jquery/jquery-3.7.1.min.js"></script>
		<script>
            
        </script>
</head>
<body>
	<!-- Modal LOGIN  -->
	<div class="modal fade" id="popupmodallogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="backdrop-filter: blur(15px);">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content">
				<form method="post" target="_self" action="">
					<div class="modal-body fw-semibold fs-5 ">
						<div class="mb-2 text-center fs-3">
						<img src="dist/logo_pelindo.png" style="width:333px;">
						<br>Login
						</div>
						<div class="mb-1">
							<label for="username" class="col-form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username" required>
						</div>
						<div class="mb-1 ">
							<label for="password" class="col-form-label">Password</label>
							<div class="input-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
								<span class="input-group-text toggle-password" id="btnpass" style="cursor: pointer;" onclick="togglePass('password','btnpass')">
									<svg width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
										<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
										<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
									</svg>
								</span>
							</div>
						</div>
					</div>
					<div class="modal-footer ">
						<div class="d-flex justify-content-center w-100">
							<button type="submit" name="loginauth" id="loginauth" class="btn btn-primary" style="width:100%;">Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div><!-- End of Modal LOGIN-->

	<!-- Modal NOTIFICATION -->
	<div class="modal fade" id="popupmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content">
				<div class="modal-body fw-semibold fs-5 text-center" id="popupcontent"><!-- Modal content text --></div>
				<div class="modal-footer align-middle ">
					<button type="button" class="btn btn-outline-info" data-bs-dismiss="modal" onclick="refreshPage()">
						<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
							<path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
							<path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
						</svg>
					OK</button>
				</div>
			</div>
		</div>
	</div><!-- End of Modal NOTIFICATION -->

	<script>
    function popupmodaluser(){
        new bootstrap.Modal(document.getElementById('popupmodallogin')).show()
        // document.getElementById('content').innerHTML=textcontent
    }
	function popupmodal(textcontent){
		new bootstrap.Modal(document.getElementById('popupmodal')).show()
		document.getElementById('popupcontent').innerHTML=textcontent
	}
	function popupmodalrole(){
        new bootstrap.Modal(document.getElementById('popupmodalrole')).show()
    }
    function refreshPage() {
        document.location='index.php';
    }
	function togglePass(xid,btnid){
        let idpass=document.getElementById(xid).type
        if(idpass=="password"){
            document.getElementById(xid).type="text"
			document.getElementById(btnid).innerHTML = `<svg xmlns="" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
			<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
			<path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
			<path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
			</svg>`
        }
        else{
            document.getElementById(xid).type="password"
			document.getElementById(btnid).innerHTML = `<svg width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
			<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
			<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
			</svg>`
        }
    }
    </script>
</body>
</html>
<?php
if(isset($_POST['loginauth'])){
    session_unset();
    if(isset($_SESSION['loginauth'])){
		session_destroy();
	}
	// Prepare JSON Data
    $data = array(
        "application_id" => htmlspecialchars("8066"),
        "user_name" => strip_tags($_POST['username']),
        "user_password" => strip_tags($_POST['password'])
    );
    $json_data = json_encode($data);

	// initialize cURL address
    $url = 'http://eap-prsi-19c.pelindo.co.id/portalsi-ws/portalsi/loginVal';
    $ch = curl_init($url);

    // cURL Options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_data)
    ));

	// Execute request & error check
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }

    curl_close($ch);
    $result = json_decode($response);

	if($_POST['username']!="" || $_POST['password']!=""){
		if($result->kode=="S"){
			$sesi=$_POST['username']."".$_POST['password'];
			$username=$_POST['username'];

			$hakAksesArr = explode(',', $result->HAKAKSES);
			$hakAksesDescArr = explode(',', $result->HAKAKSES_DESC);

			$optionform = [];
			for ($n=0; $n<count($hakAksesArr); $n++) {
				$optionform[$hakAksesArr[$n]] = $hakAksesDescArr[$n];
			}
			?>
			<!-- Modal Role Hak Akses  -->
			<div class="modal fade" id="popupmodalrole" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="backdrop-filter: blur(15px);">
				<div class="modal-dialog modal-dialog-centered modal-md">
					<div class="modal-content">
						<form method="post" target="_self" action="role.php">
							<div class="modal-body fw-semibold fs-5 ">
								<div class="mb-2 text-center fs-3"><?=$result->pesan;?></div>
								<div class="mb-1">
									<input type="hidden" name="loginauth" value="<?=$sesi;?>">
									<input type="hidden" name="username"  value="<?=$username?>">
									<select class="form-control" name="role" id="role">
										<?php
										foreach ($optionform as $value => $label) {
											echo "<option value=\"$value\">$label</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="modal-footer ">
								<div class="d-flex justify-content-center w-100">
									<button type="submit" name="loginrole" id="loginrole" class="btn btn-primary" style="width:100%;">OK</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div><!-- End of Modal Role Hak Akses-->
			<script>popupmodalrole();</script>
			<?php
		}
		else {
			?><script>popupmodaluser(); popupmodal("<?=$result->pesan;?>");</script><?php
		}
    }
	else{
		?><script>popupmodaluser(); popupmodal("Username dan Password kosong !");</script><?php
	}
}
else{
    ?><script>popupmodaluser()</script><?php
}
?>