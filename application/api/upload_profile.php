<?php 
require('../config/server.inc.php');
require('../config/config.php');
require('../config/database.php'); 
require('../config/function.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new Database();
$conn = $db->conn();


if(!isset($_REQUEST['uid'])){
  mysqli_close($conn);
  die();
}

$uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);

if(isset($_FILES)){
    $originalName = $_FILES['file']['name'];
    $path = '../img/profile';

    $generatedName = $dateu.'-'.$uid.'-'.$_FILES['file']['name'];
    $filePath = $path."/".$generatedName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        $fileUrl = ROOT_DOMAIN.'img/profile/'.$generatedName;

        $strSQL = "UPDATE sis_account SET PHOTO = '$fileUrl' WHERE USERNAME = '$uid'";
        $res = $db->execute($strSQL, false);

        echo "Success";
        $db->close(); 
        die();
    }else{
        echo "Fail x1003";
        $db->close(); 
        die();
    }
}else{
    echo "Fail x1002";
    $db->close(); 
    die();
}

