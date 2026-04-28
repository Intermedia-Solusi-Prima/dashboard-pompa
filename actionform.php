<html>
    <head>
        <link href="dist/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="dist/bootstrap/bootstrap.bundle.min.js"></script>
        
    </head>
    <body>
        <!-- Modal NOTIFICATION POMPA -->
		<div class="modal fade" id="popupmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body fw-semibold fs-5 text-center" id="popupcontent"><!-- Modal content text --></div>
					<div class="modal-footer align-middle ">
						<button type="button" class="btn btn-outline-info" data-bs-dismiss="modal" onclick="redirectPompa()">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
							<path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
							<path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
							</svg>
						OK</button>
					</div>
				</div>
			</div>
		</div><!-- End of Modal NOTIFICATION POMPA -->

        <!-- Modal NOTIFICATION USER -->
		<div class="modal fade" id="popupmodaluser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body fw-semibold fs-5" id="popupcontentuser"><!-- Modal content text --></div>
					<div class="modal-footer align-middle ">
						<button type="button" class="btn btn-outline-info" data-bs-dismiss="modal" onclick="redirectUser()">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
							<path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
							<path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
							</svg>
						OK</button>
					</div>
				</div>
			</div>
		</div><!-- End of Modal NOTIFICATION USER -->
        <script>
            function popupmodalpompa(textcontent){
                new bootstrap.Modal(document.getElementById('popupmodal')).show()
                document.getElementById('popupcontent').innerHTML=textcontent
            }
            function redirectPompa(){
                document.location='daftarpompa.php';
            }

            function popupmodaluser(textcontent){
                new bootstrap.Modal(document.getElementById('popupmodaluser')).show()
                document.getElementById('popupcontentuser').innerHTML=textcontent
            }
            function redirectUser(){
                document.location='usermgmt.php';
            }
        </script>
    </body>
</html>
<?php
require_once("orc_conn.php");

// initialize file upload
$target_dir = "file_documents_pompa";
if (!is_dir($target_dir)) {
    mkdir($target_dir); //buat foder baru jika belum ada
}
$filename=basename($_FILES['filedoc']['name']);
$target_file = $target_dir."/".$filename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

/* TAMBAH DATA POMPA ----------------- */
if(isset($_POST['tambahpompa'])){
    
    // cek file size no more than 5MB // cek file formats // Cek existing file
    if ($_FILES['filedoc']['size'] > 5242880 || $imageFileType != "pdf" || file_exists($target_file)){
        $uploadOk = 0;
    }
    if(($_POST['idpompa']!="" && $_POST['lokasipompa']!="" && $_POST['merk']!="")){
        $sqlpompa="SELECT COUNT(*) AS TOTAL_ROWS FROM TB_POMPA WHERE ID_POMPA='$_POST[idpompa]'";
        $data=oci_parse($conn,$sqlpompa);
        oci_execute($data);
        $numrow=oci_fetch_array($data);
        if($numrow['TOTAL_ROWS']>0){                                                //cek data agar tidak ada double input
            ?><script>popupmodalpompa("Data ID Pompa tersebut ganda, sudah ada di database sebelumnya !");</script><?php
        }
        else{
            if($filename!=null && $uploadOk == 0){
                ?><script>popupmodalpompa("File dokumen yang diupload bukan tipe file *.PDF atau melebihi 5MB atau nama file sama !");</script><?php
            }
            else{
                // if($_POST['tglbeli']==""){$tglbeli="2000-01-01";}
                //else{}$tglbeli=;
                $sqltambahpompa="INSERT INTO POMPA.TB_POMPA (ID_POMPA,LOKASI_POMPA,SN_POMPA,MERK_POMPA,DAYA_POMPA,TGL_BELI,VENDOR,HEADMAX,KAPASITAS,DIAMETER_PIPA,TIPE_POMPA,LISTRIK_PLN,LISTRIK_GENSET,CATCHMENT,GARANSI,FILE_DOC) VALUES (:col1,:col2,:col3,:col4,:col5,TO_DATE(:col6,'YYYY-MM-DD'),:col7,:col8,:col9,:col10,:col11,:col12,:col13,:col14,:col15,:col16)";
                $parseadd=oci_parse($conn,$sqltambahpompa);
                // oci_bind_by_name($parseadd, ':nomor', POMPA_SEQ.NEXTVAL);
                oci_bind_by_name($parseadd, ':col1', $_POST['idpompa']);
                oci_bind_by_name($parseadd, ':col2', $_POST['lokasipompa']);
                oci_bind_by_name($parseadd, ':col3', $_POST['sn']);
                oci_bind_by_name($parseadd, ':col4', $_POST['merk']);
                oci_bind_by_name($parseadd, ':col5', $_POST['dayapompa']);
                oci_bind_by_name($parseadd, ':col6', $_POST['tglbeli']);
                oci_bind_by_name($parseadd, ':col7', $_POST['vendor']);
                oci_bind_by_name($parseadd, ':col8', $_POST['head']);
                oci_bind_by_name($parseadd, ':col9', $_POST['kapasitas']);
                oci_bind_by_name($parseadd, ':col10', $_POST['diameterpipa']);
                oci_bind_by_name($parseadd, ':col11', $_POST['tipepompa']);
                oci_bind_by_name($parseadd, ':col12', $_POST['sumberpln']);
                oci_bind_by_name($parseadd, ':col13', $_POST['sumbergenset']);
                oci_bind_by_name($parseadd, ':col14', $_POST['catchment']);
                oci_bind_by_name($parseadd, ':col15', $_POST['garansi']);
                oci_bind_by_name($parseadd, ':col16', $filename);
                if(oci_execute($parseadd)){
                    move_uploaded_file($_FILES['filedoc']['tmp_name'], $target_file);
                    ?><script>popupmodalpompa("Data telah berhasil ditambahkan");</script><?php
                }
                else { ?><script>popupmodalpompa("Terjadi kesalahan. Data gagal ditambahkan !");</script><?php }
            }
        }
    }
    else { ?><script>popupmodalpompa("Data pada kolom masih kosong, harus diisi !");</script><?php }
oci_free_statement($data);
oci_free_statement($parseadd);
}/* END of TAMBAH DATA POMPA ----------------- */

/* UPDATE DATA POMPA ----------------- */
if (isset($_POST['updatepompa'],$_POST['idno'])){

    // cek file size no more than 5MB // cek file formats // Cek existing file
    if ($_FILES['filedoc']['size'] > 5242880 || $imageFileType != "pdf" || file_exists($target_file)){
        $uploadOk = 0;
    }
	
	if($filename!=null && $uploadOk == 0){
        ?><script>popupmodalpompa("UPDATE GAGAL !<br>File dokumen yang diupload bukan tipe file *.PDF atau melebihi 5MB atau nama file sama");</script><?php
	}
	else{
        // if($_POST['tglbeli']==""){$tglbeli="2000-01-01";}
        // else{$tglbeli=$_POST['tglbeli'];}

        if($filename==null && $_POST['filedoc_edit']!=null){$filename=$_POST['filedoc_edit'];}
        else if($filename!=null && $_POST['filedoc_edit']!=null){
            if(file_exists($target_dir."/".$_POST['filedoc_edit'])){
                unlink($target_dir."/".$_POST['filedoc_edit']);
            }
        }

        $sqlupdatepompafile="UPDATE TB_POMPA SET LOKASI_POMPA=:col2,SN_POMPA=:col3,MERK_POMPA=:col4,DAYA_POMPA=:col5,TGL_BELI=TO_DATE(:col6,'YYYY-MM-DD'),VENDOR=:col7,HEADMAX=:col8,KAPASITAS=:col9,DIAMETER_PIPA=:col10,TIPE_POMPA=:col11,LISTRIK_PLN=:col12,LISTRIK_GENSET=:col13,CATCHMENT=:col14,GARANSI=:col15,FILE_DOC=:col16 WHERE NOMOR=:nomor";
        $parseupd=oci_parse($conn,$sqlupdatepompafile);
        oci_bind_by_name($parseupd, ':nomor', $_POST['idno']);
        oci_bind_by_name($parseupd, ':col2', $_POST['lokasipompa']);
        oci_bind_by_name($parseupd, ':col3', $_POST['sn']);
        oci_bind_by_name($parseupd, ':col4', $_POST['merk']);
        oci_bind_by_name($parseupd, ':col5', $_POST['dayapompa']);
        oci_bind_by_name($parseupd, ':col6', $_POST['tglbeli']);
        oci_bind_by_name($parseupd, ':col7', $_POST['vendor']);
        oci_bind_by_name($parseupd, ':col8', $_POST['head']);
        oci_bind_by_name($parseupd, ':col9', $_POST['kapasitas']);
        oci_bind_by_name($parseupd, ':col10', $_POST['diameterpipa']);
        oci_bind_by_name($parseupd, ':col11', $_POST['tipepompa']);
        oci_bind_by_name($parseupd, ':col12', $_POST['sumberpln']);
        oci_bind_by_name($parseupd, ':col13', $_POST['sumbergenset']);
        oci_bind_by_name($parseupd, ':col14', $_POST['catchment']);
        oci_bind_by_name($parseupd, ':col15', $_POST['garansi']);
        oci_bind_by_name($parseupd, ':col16', $filename);
        if(oci_execute($parseupd)){
            oci_commit($conn);
            move_uploaded_file($_FILES['filedoc']['tmp_name'], $target_file);
            ?><script>popupmodalpompa("Data dan file dokumen telah berhasil diupdate");//location.replace("daftarpompa.php")</script><?php
        }
        else { ?><script>popupmodal("Data gagal diupdate !")</script><?php }
	}
	
oci_free_statement($parseupd);
}/* END of UPDATE DATA POMPA ----------------- */
oci_close($conn);
// header("Location: daftarpompa.php");
?>