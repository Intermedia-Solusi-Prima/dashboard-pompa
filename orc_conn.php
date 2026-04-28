<?php
$hostserver="dbdev.pelindo.id";
$namadb="";
$userdb="pompa";
$passdb="B4nj1r_pomp4_25";
$port="1628";
$sid="intranetdev";

$connection_string="(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$hostserver)(PORT=$port))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=$sid)))";
$conn = oci_connect($userdb, $passdb, $connection_string);

if (!$conn) {
    $err = oci_error();
    die("Connection failed: " . $err['message']);
} else {
    // echo "Connection successful to Oracle database.";
}
// oci_close($conn);
?>
