<?php
if(isset($_POST['loginrole'])){
    session_start();					//buat session profil baru
    $_SESSION['loginauth']=$_POST['loginauth'];
    $_SESSION['username']=$_POST['username'];
    // 5337 Administrator=admin
    // 5339 Manager=teknik
    // 5341 User=viewer
    if($_POST['role']=="5337"){
        $_SESSION['role']="admin";
    }
    elseif($_POST['role']=="5339"){
        $_SESSION['role']="teknik";
    }
    else{
        $_SESSION['role']="viewer";
    }
    ?><script>document.location='index.php';</script><?php
}
else{
    ?><script>document.location='index.php';</script><?php
}
?>