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

if($stage == 'create'){
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

    $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $target_uid = mysqli_real_escape_string($conn, $_POST['target_uid']);
    $targe_role = mysqli_real_escape_string($conn, $_POST['targe_role']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = base64_encode($password);

    $strSQL = "INSERT INTO sis_account (`UID`, `ACTIVE_STATUS`, `UDATETIME`, `ROLE`) VALUES ('$target_uid', 'Y', '$datetime', '$targe_role')";
    $resInsert = $db->insert($strSQL, false);
    if($resInsert){
        $strSQL = "INSERT INTO sis_userinfo 
                   (
                       `UID`, `PREFIX`, `FNAME`, `MNAME`, `LNAME`, 
                       `USERNAME`, `EMAIL`, `UDATETIME`, `USE_STATUS`
                   ) 
                   VALUES 
                   (
                       '$target_uid', '$prefix', '$fname', '$mname', '$lname', 
                       '$username', '$email', '$datetime', 'Y'
                   )";
        $resInsert = $db->insert($strSQL, false);

        if($targe_role == 'student'){
            $strSQL = "INSERT INTO sis_student_info 
                       (
                        `std_id`, `username`
                       )
                       VALUES 
                       (
                        '$username', '$username'
                       )
                      ";
            $resInsert2 = $db->insert($strSQL, false);

            if($resInsert2){
                $return['status'] = 'Success';
                $return['uid'] = $target_uid;
            }else{
                $return['status'] = 'Fail';
                $return['error_message'] = $strSQL;
            }
        }else{
            $return['status'] = 'Success';
            $return['uid'] = $target_uid;
        }
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_education_info'){
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
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);

    $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $edudate = mysqli_real_escape_string($conn, $_POST['edudate']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $graddate = mysqli_real_escape_string($conn, $_POST['graddate']);
    $gradyear = mysqli_real_escape_string($conn, $_POST['gradyear']);
    $academicyear = mysqli_real_escape_string($conn, $_POST['academicyear']);
    
    $strSQL = "UPDATE sis_student_info 
               SET 
               `std_degree` = '$degree', 
               `std_country` = '$country', 
               `std_start_year` = '$academicyear', 
               `std_start_edu_date` = '$edudate', 
               `std_set_start_year` = '$date', 
               `std_grad_year` = '$gradyear', 
               `std_grad_date`= '$graddate', 
               `std_set_grad_year` = '$gradyear', 
               `std_study_status` = '$status'
               WHERE 
                std_id = '$student_id'
              ";
    $resUpdate = $db->execute($strSQL);
    insertLog($db, $ip, $datetime, $uid, 'Update student education info', 'Updated UID : '.$target_uid, $target_uid);
    $return['status'] = 'Success';
    $return['sql'] = $strSQL;
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'addScholar'){
    if(
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['target_uid'])) ||
        (!isset($_REQUEST['target_student_id']))
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
    $target_student_id = mysqli_real_escape_string($conn, $_POST['target_student_id']);
    $scholar = mysqli_real_escape_string($conn, $_POST['scholar']);
    $scholar_other = mysqli_real_escape_string($conn, $_POST['scholar_other']);

    if($scholar != '11'){
        $strSQL = "INSERT INTO sis_student_scholarship (`sss_scholar`, `sss_scholar_info`, `sss_udatetime`, `sss_std_id`) VALUES ('$scholar', '$scholar_other', '$datetime', '$target_student_id')";
        $resInsert = $db->insert($strSQL, false);
        if($resInsert){
            insertLog($db, $ip, $datetime, $uid, 'Add student scholarship', 'Updated UID : '.$target_uid, $target_uid);
            $return['status'] = 'Success';
        }else{
            $return['status'] = 'Fail';
        }
    }else{
        $strSQL = "SELECT * FROM sis_student_scholarship WHERE sss_scholar = '$scholar' AND sss_std_id = '$target_student_id' AND sss_delete = 'N'";
        $res = $db->fetch($strSQL, false, false);
        if($res){
            $return['status'] = 'Success';
        }else{
            $strSQL = "INSERT INTO sis_student_scholarship (`sss_scholar`, `sss_scholar_info`, `sss_udatetime`, `sss_std_id`) VALUES ('$scholar', '$scholar_other', '$datetime', '$target_student_id')";
            $resInsert = $db->insert($strSQL, false);
            if($resInsert){
                insertLog($db, $ip, $datetime, $uid, 'Add student scholarship', 'Updated UID : '.$target_uid, $target_uid);
                $return['status'] = 'Success';
            }else{
                $return['status'] = 'Fail';
            }
        }
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'listScholar'){
    if(
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['target_uid'])) ||
        (!isset($_REQUEST['target_student_id']))
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
    $target_student_id = mysqli_real_escape_string($conn, $_POST['target_student_id']);

    $strSQL = "SELECT * 
               FROM sis_student_scholarship a INNER JOIN sis_fundingsource b ON a.sss_scholar = b.fs_id
               WHERE a.sss_std_id = '$target_student_id' AND a.sss_delete = 'N'";
    $res = $db->fetch($strSQL, true, true);

    if(($res) && ($res['status'])){
        $return['status'] = 'Success';
        $return['data'] = $res['data'];
    }else{
        $return['status'] = 'Fail';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'deleteScholar'){
    if(
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['sl_id'])) ||
        (!isset($_REQUEST['target_student_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $sl_id = mysqli_real_escape_string($conn, $_POST['sl_id']);
    $target_student_id = mysqli_real_escape_string($conn, $_POST['target_student_id']);

    $strSQL = "UPDATE sis_student_scholarship SET sss_delete = 'Y' WHERE sss_id = '$sl_id' AND sss_std_id = '$target_student_id'";
    $res = $db->execute($strSQL);

    $strSQL = "SELECT UID FROM sis_userinfo WHERE USERNAME = '$target_student_id' AND USE_STATUS = 'Y'";
    $res = $db->fetch($strSQL, false, false);
    if($res){
        $target_uid = $res['UID'];
        insertLog($db, $ip, $datetime, $uid, 'Delete student scholarship', 'Updated Student ID : '.$target_uid, $target_uid);
        $return['target_uid'] = $target_uid;
    }
    $return['status'] = 'Success';
    
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

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