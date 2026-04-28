<html>
    <head>
        <link href="dist/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="dist/bootstrap/bootstrap.bundle.min.js"></script>
        
    </head>
    <body>
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
        <script>
            function popupmodal(textcontent){
                new bootstrap.Modal(document.getElementById('popupmodal')).show()
                document.getElementById('popupcontent').innerHTML=textcontent
            }
            function redirect(){
                document.location='daftarpompa.php';
            }
        </script>
    </body>
</html>
<?php
require_once("db_pompa_conn.php");

/* TAMBAH DATA ----------------- */
if(isset($_POST['tambahpompa'])){

    if(($_POST['idpompa']!="" && $_POST['lokasipompa']!="" && $_POST['merk']!="")){
        $sqlpompa="SELECT * FROM tb_pompa WHERE id_pompa='$_POST[idpompa]'";
        $data=$mysqli->query($sqlpompa);
        if($data->num_rows>0){                                                //cek data agar tidak ada double input
            ?><script>popupmodal("Data ID Pompa tersebut ganda, sudah ada di database sebelumnya !");</script><?php
        }
        else{
            if($_POST['tglbeli']==""){$tglbeli="2000-01-01";}
            else{$tglbeli=$_POST['tglbeli'];}
            $sqltambahpompa="INSERT INTO tb_pompa (`nomor`,`id_pompa`,`lokasi_pompa`,`sn_pompa`,`merk_pompa`,`daya_pompa`,`tgl_beli`,`vendor`,`headmax`,`kapasitas`,`diameter_pipa`,`tipe_pompa`,`listrik_pln`,`listrik_genset`,`catchment`,`garansi`,`file_doc`) VALUES (NULL,'$_POST[idpompa]','$_POST[lokasipompa]','$_POST[sn]','$_POST[merk]','$_POST[dayapompa]','$tglbeli','$_POST[vendor]','$_POST[head]','$_POST[kapasitas]','$_POST[diameterpipa]','$_POST[tipepompa]','$_POST[sumberpln]','$_POST[sumbergenset]','$_POST[catchment]','$_POST[garansi]','$_POST[filedoc]')";
            $mysqli->query($sqltambahpompa);
            ?><script>popupmodal("Data telah berhasil ditambahkan");</script><?php
        }
    }
    else{
        ?><script>popupmodal("Data pada kolom masih kosong, harus diisi !");</script><?php
    }
}/* END of TAMBAH DATA ----------------- */


/* UPDATE DATA ----------------- */
if (isset($_POST['updatepompa'],$_POST['idno'])){
		
	if($_POST['tglbeli']==""){$tglbeli="2000-01-01";}
    else{$tglbeli=$_POST['tglbeli'];}

	$sqlupdatepompa="UPDATE tb_pompa SET lokasi_pompa='$_POST[lokasipompa]',sn_pompa='$_POST[sn]',merk_pompa='$_POST[merk]',daya_pompa='$_POST[dayapompa]',tgl_beli='$tglbeli',vendor='$_POST[vendor]',headmax='$_POST[head]',kapasitas='$_POST[kapasitas]',diameter_pipa='$_POST[diameterpipa]',tipe_pompa='$_POST[tipepompa]',listrik_pln='$_POST[sumberpln]',listrik_genset='$_POST[sumbergenset]',catchment='$_POST[catchment]',garansi='$_POST[garansi]',file_doc='$_POST[filedoc]' WHERE nomor='$_POST[idno]'";
	
	if($mysqli->query($sqlupdatepompa) == TRUE){
		?><script>popupmodal("Data telah berhasil diupdate");//location.replace("daftarpompa.php")</script><?php
		
	}
	else{
		?><script>popupmodal("Data gagal diupdate !");</script><?php
	}
	
	// header("Location: daftarpompa.php");

}/* END of UPDATE DATA ----------------- */


/* HAPUS DATA ----------------- */
if(isset($_POST['absolutelydelete'],$_POST['iddelete'])){
	echo $_POST['iddelete'];

	// if(isset($_POST['absolutelydelete'])){}
	$sqldelete="DELETE FROM tb_pompa WHERE nomor='$_POST[iddelete]'";

		if ($mysqli->query($sqldelete) === TRUE) {
		?><script>popupmodal("Data telah berhasil dihapus")</script><?php
		} else {
		?><script>popupmodal("Data gagal dihapus !");</script><?php
		}
	
}/* END of HAPUS DATA ----------------- */
$mysqli->close();
?>