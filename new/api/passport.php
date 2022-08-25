<?php 
require('../config/php/config.php');
require('../config/php/database.php'); 
require('../config/php/function.php'); 

$return = array();

if(
    (!isset($_REQUEST['uid'])) ||
    (!isset($_REQUEST['name'])) ||
    (!isset($_REQUEST['surname'])) ||
    (!isset($_REQUEST['dept'])) ||
    (!isset($_REQUEST['dept_id'])) ||
    (!isset($_REQUEST['position'])) ||
    (!isset($_REQUEST['stdid'])) ||
    (!isset($_REQUEST['email']))
  ){
    $return['status'] = 'Fail';
    $return['error_message'] = 'Error x1001';
    echo "Invalid parameters<br>";
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

$uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
$surname = mysqli_real_escape_string($conn, $_REQUEST['surname']);
$dept = mysqli_real_escape_string($conn, $_REQUEST['dept']);
$dept_id = mysqli_real_escape_string($conn, $_REQUEST['dept_id']);
$position = mysqli_real_escape_string($conn, $_REQUEST['position']);
$stdid = mysqli_real_escape_string($conn, $_REQUEST['stdid']);
$email = mysqli_real_escape_string($conn, $_REQUEST['email']);

$strSQL = "SELECT * FROM sis_account a INNER JOIN sis_userinfo b ON a.USERNAME = b.USERNAME 
           WHERE 
           a.ACTIVE_STATUS = 'Y' 
           AND a.DELETE_STATUS = 'N' 
           AND b.USE_STATUS = 'Y' 
           AND a.USERNAME = '$uid'
           ";
$res = $db->fetch($strSQL, false, false);
if($res){

    $_SESSION['doe_uid'] = $uid; // username

    if($res['ROLE_ADMIN'] == 'Y'){
        $_SESSION['doe_sis_role'] = 'admin';
    }else{
        if($res['ROLE_STAFF'] == 'Y'){
            $_SESSION['doe_sis_role'] = 'staff';
        }else{
            if($res['ROLE_LECTURER'] == 'Y'){
                $_SESSION['doe_sis_role'] = 'lecturer';
            }else{
                $_SESSION['doe_sis_role'] = 'student';
            }
        }
    }
    
    $_SESSION['doe_id'] = session_id();
    $db->close();

    if($_SESSION['doe_sis_role'] == 'student'){
        header('Location: ../student/');       
    }else{
        header('Location: ../staff/');       
    }
    

    die();

}else{
    $db->close();
    header('Location: ../html/core/auth/register?uid='.$uid.'&name='.$name.'&surname='.$surname.'&dept='.$dept.'&dept_id='.$dept_id.'&position='.$position.'&stdid='.$stdid.'&email='.$email);        
    die();
}
?>