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

require('../config/sendemail.php'); 

if(!isset($_REQUEST['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_REQUEST['stage']);

if($stage == 'update_basic_info'){
    if(
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['target_uid']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $target_uid = mysqli_real_escape_string($conn, $_POST['target_uid']);

    $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $targe_role = mysqli_real_escape_string($conn, $_POST['targe_role']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);

    $strSQL = "UPDATE sis_account SET ROLE = '$targe_role' WHERE UID = '$target_uid'";
    $db->execute($strSQL);

    $strSQL = "SELECT * FROM sis_userinfo WHERE UID = '$target_uid' AND USE_STATUS = 'Y'";
    $res = $db->fetch($strSQL, false, false);
    if($res){
        $strSQL = "UPDATE sis_userinfo SET USE_STATUS = 'N' WHERE UID = '$target_uid'";
        $db->execute($strSQL);
        $email = $res['EMAIL'];

        $strSQL = "INSERT INTO sis_userinfo
                   (`UID`, `PREFIX`, `FNAME`, `MNAME`, `LNAME`, `POSITION`, `USERNAME`, `EMAIL`, `UDATETIME`, `USE_STATUS`)
                   VALUES 
                   ('$target_uid', '$prefix', '$fname', '$mname', '$lname', '$position', '$username', '$email', '$datetime', 'Y')
                  ";
        $resInnsert = $db->insert($strSQL, false);
        if($resInnsert){
            insertLog($db, $ip, $datetime, $uid, 'Update user info', 'Updated UID : '.$target_uid, $target_uid);
            $return['status'] = 'Success';
        }
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'delete'){
    if(
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['target_uid']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $target_uid = mysqli_real_escape_string($conn, $_POST['target_uid']);

    if(($role == 'admin') || ($role == 'staff')){
        $strSQL = "UPDATE sis_account SET DELETE_STATUS = 'Y' WHERE UID = '$target_uid'";
        $resUpdate = $db->execute($strSQL);

        insertLog($db, $ip, $datetime, $uid, 'Delete user', 'Deleted UID : '.$target_uid, $target_uid);
        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'toggle_app'){
    if(
        (!isset($_REQUEST['system'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['cstage']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $system = mysqli_real_escape_string($conn, $_POST['system']);
    $cstage = mysqli_real_escape_string($conn, $_POST['cstage']);

    $strSQL = "SELECT $system FROM mym_useraccount WHERE UID = '$uid'";
    $res = $db->fetch($strSQL, false, false);

    if($res){

        if($system == 'ACTIVE_STATUS'){
            $new = 'N';
            if($res[$system] != 'Y'){
                $new = 'Y';
            }
            $strSQL = "UPDATE mym_useraccount SET $system = '$new' WHERE UID = '$uid'";
            $db->execute($strSQL);

            $return['status'] = 'Success';
            $return['info'] = $strSQL;
        }else{
            $new = '0';
            if($res[$system] != '1'){
                $new = '1';
            }
            $strSQL = "UPDATE mym_useraccount SET $system = '$new' WHERE UID = '$uid'";
            $db->execute($strSQL);

            $return['status'] = 'Success';
            $return['info'] = $strSQL;
        }
        
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'User not found';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}