<?php 

if(!isset($_SESSION['doe_uid'])){
    // echo "error 1";
    header('Location: '.ROOT_DOMAIN);
    die();
}

$uid = $_SESSION['sis_uid'];
$token = $_SESSION['sis_token'];

$strSQL = "SELECT * FROM sis_account a INNER JOIN sis_userinfo b ON a.UID = b.UID WHERE a.UID = '$uid' AND a.ACTIVE_STATUS = 'Y' AND b.USE_STATUS = 'Y'";
$resUser = $db->fetch($strSQL, false, false);

$currentUser = null;
if($resUser){
    $currentUser = $resUser;
}else{
    session_destroy();
    // echo "error 2";
    // die();
    header('Location: '.ROOT_DOMAIN);
    die();
}
?>
