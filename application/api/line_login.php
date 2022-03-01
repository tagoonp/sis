<?php 
require('../config/server.inc.php');
require('../config/config.php');
require('../config/database.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new Database();
$conn = $db->conn();

require('../config/sendemail.php'); 

if(!isset($_REQUEST['token'])){
    echo "Invalid token stage";
    mysqli_close($conn);
    die();
}

$token = mysqli_real_escape_string($conn, $_REQUEST['token']);
$photo = mysqli_real_escape_string($conn, $_REQUEST['photo']);

$strSQL = "SELECT * FROM mym_useraccount 
           WHERE LINELOGIN = '$token' AND ACTIVE_STATUS = 'Y' 
           AND DELETE_STATUS = 'N'";
$res = $db->fetch($strSQL, false, false);

if($res){
    $access_token = base64_encode($dateu.$res['ID']);
    $uid = $res['UID'];

    $strSQL = "UPDATE access_token SET tk_timeout = 'Y' WHERE tk_uid = '$uid'";
    $db->execute($strSQL);

    $exp_datetime = Date("Y-m-d H:i:s", strtotime("$datetime +6 hours"));

    $strSQL = "INSERT INTO access_token (`tk_token`, `tk_issue`, `tk_expire`, `tk_uid`) 
            VALUES ('$access_token', '$datetime', '$exp_datetime', '$uid')
            ";
    $resInsertToken = $db->insert($strSQL, false);

    $_SESSION['doe_uid'] = $uid;
    $_SESSION['doe_token'] = $access_token;
    $_SESSION['doe_id'] = session_id();

    header('Location: '.ROOT_DOMAIN.'html/core/'.$res['ROLE'].'/');
    mysqli_close($conn);
    die();

}else{
    
    header('Location: '.ROOT_DOMAIN.'html/core/login/link_account?token='.$token.'&photo='.$photo);
    mysqli_close($conn);
    die();
}