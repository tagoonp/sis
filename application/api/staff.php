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
$return = array();
if($stage == 'check_before_add'){

    if(
        (!isset($_REQUEST['checktype']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $checktype = mysqli_real_escape_string($conn, $_POST['checktype']);

    if($checktype == 'student'){
        if(
            (!isset($_REQUEST['degree'])) ||
            (!isset($_REQUEST['status'])) ||
            (!isset($_REQUEST['student_id']))
          ){
            $return['status'] = 'Fail';
            $return['error_message'] = 'Error x1001';
            echo json_encode($return);
            mysqli_close($conn);
            die();
        }
    
        $checktype = mysqli_real_escape_string($conn, $_POST['checktype']);
        $degree = mysqli_real_escape_string($conn, $_POST['degree']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $std_id = mysqli_real_escape_string($conn, $_POST['student_id']);
        
    
        $strSQL = "SELECT * FROM `sis_account` WHERE USERNAME = '$std_id' AND ROLE_STUDENT = 'Y' AND DELETE_STATUS = 'N'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
            $return['status'] = 'Fail';
        }else{
            $return['status'] = 'Success';
        }
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }else{
        if(
            (!isset($_REQUEST['staff_id'])) ||
            (!isset($_REQUEST['staff_type']))
          ){
            $return['status'] = 'Fail';
            $return['error_message'] = 'Error x1001';
            echo json_encode($return);
            mysqli_close($conn);
            die();
        }
    
        $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);
        $staff_type = mysqli_real_escape_string($conn, $_POST['staff_type']);
    
        $strSQL = "SELECT * FROM `sis_account` WHERE USERNAME = '$staff_id' AND STAFF_TYPE = '$staff_type' AND (ROLE_ADMIN = 'Y' OR ROLE_STAFF = 'Y' OR ROLE_LECTURER = 'Y') AND DELETE_STATUS = 'N'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
            $return['status'] = 'Fail';
            $return['cmd'] = $strSQL;
        }else{
            $return['status'] = 'Success';
        }
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    
}

if($stage == 'update_student_status'){
    if(
        (!isset($_REQUEST['student_id'])) ||
        (!isset($_REQUEST['status'])) ||
        (!isset($_REQUEST['uid']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);

    $strSQL = "UPDATE sis_student_info SET std_study_status = '$status' WHERE std_id = '$student_id'";
    $res = $db->execute($strSQL);

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'delete_account'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['delete_id']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $strSQL = "UPDATE sis_account SET DELETE_STATUS = 'Y' WHERE USERNAME = '$delete_id'";
    $resUpdate = $db->execute($strSQL);

    $strSQL = "UPDATE sis_userinfo SET USE_STATUS = 'N' WHERE USERNAME = '$delete_id'"; 
    $resUpdate = $db->execute($strSQL);

    $strSQL = "UPDATE sis_student_info SET std_delete = 'Y' WHERE username = '$delete_id'"; 
    $resUpdate = $db->execute($strSQL);

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_role'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['username'])) ||
        (!isset($_REQUEST['target_role']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $target_role = mysqli_real_escape_string($conn, $_POST['target_role']);

    $param = 'ROLE_'.$target_role;

    $strSQL = "SELECT $param FROM sis_account WHERE USERNAME = '$username'";
    $res = $db->fetch($strSQL, false, false);
    if($res){
        $curr_status = $res[$param];
        $to = 'N';
        if($curr_status == 'N'){
            $to = 'Y';
        }
        $strSQL = "UPDATE sis_account SET $param = '$to' WHERE USERNAME = '$username'";
        $resUpdate = $db->execute($strSQL);
    }
    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'add_advisor'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['adv'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['adv_type']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $adv = mysqli_real_escape_string($conn, $_POST['adv']);
    $adv_type = mysqli_real_escape_string($conn, $_POST['adv_type']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);

    $strSQL = "UPDATE sis_advisor SET adv_delete = '1' WHERE adv_std_id = '$std_id' AND adv_type = '$adv_type'"; 
    $resUpdate = $db->execute($strSQL);

    $strSQL = "INSERT INTO sis_advisor (`adv_username`, `adv_type`, `adv_udatetime`, `adv_std_id`) VALUES ('$adv', '$adv_type', '$datetime', '$std_id')";
    $resInsert = $db->insert($strSQL, false);

    $return['status'] = 'Fail';
    if($resInsert){
        $return['status'] = 'Success';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'delete_adv'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['adv_id']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $adv_id = mysqli_real_escape_string($conn, $_POST['adv_id']);

    $strSQL = "UPDATE sis_advisor SET adv_delete = '1' WHERE adv_id = '$adv_id'"; 
    $resUpdate = $db->execute($strSQL);

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'add_new_staff'){
    if(
        (!isset($_REQUEST['staff_type'])) ||
        (!isset($_REQUEST['staff_id'])) ||
        (!isset($_REQUEST['prefix'])) ||
        (!isset($_REQUEST['fname'])) ||
        (!isset($_REQUEST['lname'])) ||
        (!isset($_REQUEST['email'])) ||
        (!isset($_REQUEST['password']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $staff_type = mysqli_real_escape_string($conn, $_POST['staff_type']);
    $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);
    $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $password = base64_encode($password);

    $strSQL = "SELECT * FROM `sis_account` WHERE USERNAME = '$staff_id' AND (ROLE_STAFF = 'Y' OR ROLE_LECTURER = 'Y' OR ROLE_ADMIN = 'Y') AND DELETE_STATUS = 'N'";
    $resCheck = $db->fetch($strSQL, false, false);

    if($resCheck){
        $return['status'] = 'Fail';
        $return['code'] = 'x1002';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    
    $strSQL = "INSERT INTO sis_account (`USERNAME`, `UDATETIME`, `ROLE`, `ROLE_STAFF`, `STAFF_TYPE`, `PASSWORD`) VALUES ('$staff_id', '$datetime', 'staff', 'Y', '$staff_type', '$password')";
    $resInsert = $db->insert($strSQL, false);
    if($resInsert){
        $strSQL = "UPDATE sis_userinfo SET USE_STATUS = 'N' WHERE USERNAME = '$staff_id'"; $resUpdate = $db->execute($strSQL);

        $strSQL = "INSERT INTO sis_userinfo 
                  (`PREFIX`, `FNAME`, `MNAME`, `LNAME`, `EMAIL`, `USERNAME`, `UDATETIME`) 
                  VALUES ('$prefix', '$fname', '$mname', '$lname', '$email', '$staff_id', '$datetime')";
        $resInsert2 = $db->insert($strSQL, false);
        if($resInsert2){
            $return['status'] = 'Success';
        }else{
            $return['status'] = 'Fail';
            $return['code'] = 'x1004';
            $return['command'] = $strSQL;
        }
    }else{
        $return['status'] = 'Fail';
        $return['code'] = 'x1003';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();

}

if($stage == 'add_new_student'){
    if(
        (!isset($_REQUEST['degree'])) ||
        (!isset($_REQUEST['status'])) ||
        (!isset($_REQUEST['student_id'])) ||
        (!isset($_REQUEST['prefix'])) ||
        (!isset($_REQUEST['fname'])) ||
        (!isset($_REQUEST['lname']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $std_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $start_year = mysqli_real_escape_string($conn, $_POST['start_year']);
    $start_edu_date = mysqli_real_escape_string($conn, $_POST['start_edu_date']);

    $strSQL = "SELECT * FROM `sis_account` WHERE USERNAME = '$std_id' AND ROLE_STUDENT = 'Y' AND DELETE_STATUS = 'N'";
    $resCheck = $db->fetch($strSQL, false, false);

    if($resCheck){
        $return['status'] = 'Fail';
        $return['code'] = 'x1002';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    
    $strSQL = "INSERT INTO sis_account (`USERNAME`, `UDATETIME`, `ROLE`, `ROLE_STUDENT`) VALUES ('$std_id', '$datetime', 'student', 'Y')";
    $resInsert = $db->insert($strSQL, false);
    if($resInsert){
        $strSQL = "UPDATE sis_userinfo SET USE_STATUS = 'N' WHERE USERNAME = '$std_id'"; $resUpdate = $db->execute($strSQL);

        $strSQL = "INSERT INTO sis_userinfo 
                  (`PREFIX`, `FNAME`, `MNAME`, `LNAME`, `USERNAME`, `UDATETIME`) 
                  VALUES ('$prefix', '$fname', '$mname', '$lname', '$std_id', '$datetime')";
        $resInsert2 = $db->insert($strSQL, false);
        if($resInsert2){
            $strSQL = "INSERT INTO sis_student_info (
                         `std_id`, `std_degree`, `std_status`, `std_start_year`, `std_start_edu_date`, 
                         `std_set_start_year`, `std_confirm`, `std_study_status`, `username`
                       )
                       VALUES (
                        '$std_id', '$degree', '1', '$start_year', '$start_edu_date', 
                        '$date', 'No', '$status', '$std_id'
                       )
                      ";
            $resInsert3 = $db->insert($strSQL, false);
            if($resInsert3){
                $return['status'] = 'Success';
            }else{
                $return['status'] = 'Fail';
                $return['code'] = 'x1005'; 
            }
        }else{
            $return['status'] = 'Fail';
            $return['code'] = 'x1004';
            $return['command'] = $strSQL;
        }
    }else{
        $return['status'] = 'Fail';
        $return['code'] = 'x1003';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}
?>