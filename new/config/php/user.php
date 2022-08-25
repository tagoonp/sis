<?php 
$uid = $_SESSION['doe_uid'];
$role = $_SESSION['doe_sis_role'];

$strSQL = "SELECT * FROM sis_account a INNER JOIN sis_userinfo b ON a.USERNAME = b.USERNAME WHERE a.ACTIVE_STATUS = 'Y' AND a.DELETE_STATUS = 'N' AND b.USE_STATUS = 'Y' AND a.USERNAME = '$uid'";
if($role == 'student'){
    $strSQL = "SELECT * FROM sis_account a INNER JOIN sis_userinfo b ON a.USERNAME = b.USERNAME 
               INNER JOIN sis_student_info c ON a.USERNAME = c.std_id
               WHERE 
                a.ACTIVE_STATUS = 'Y' 
                AND a.DELETE_STATUS = 'N' 
                AND b.USE_STATUS = 'Y' 
                AND a.USERNAME = '$uid'
                AND c.std_delete = 'N'
               ";
}
$resUser = $db->fetch($strSQL, false, false);

$currentUser = null;
if($resUser){
    $currentUser = $resUser;
}else{
    session_destroy();
    // echo "Error";
    // die();
    header('Location: '.ROOT_DOMAIN);
    die();
}
?>
<input type="hidden" id="txtUid" value="<?php echo $uid; ?>">
<input type="hidden" id="txtRole" value="<?php echo $role; ?>">