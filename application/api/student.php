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

if($stage == 'update_student_profile'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['username'])) ||
        (!isset($_REQUEST['contry'])) ||
        (!isset($_REQUEST['fname'])) ||
        (!isset($_REQUEST['lname'])) ||
        (!isset($_REQUEST['prefix'])) 
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $country = mysqli_real_escape_string($conn, $_POST['contry']);
    $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);

    $strSQL = "UPDATE sis_student_info SET std_country = '$country' WHERE std_id = '$username'";
    $resUpdate = $db->execute($strSQL);

    $strSQL = "UPDATE sis_userinfo SET PREFIX = '$prefix', FNAME = '$fname', MNAME = '$mname', LNAME = '$lname' WHERE USERNAME = '$username'";
    $resUpdate = $db->execute($strSQL);

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_student_address'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['username'])) ||
        (!isset($_REQUEST['email'])) 
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $hmtel = mysqli_real_escape_string($conn, $_POST['hmtel']);
    $hmaddress = mysqli_real_escape_string($conn, $_POST['hmaddress']);
    $wptel = mysqli_real_escape_string($conn, $_POST['wptel']);
    $wpaddress = mysqli_real_escape_string($conn, $_POST['wpaddress']);
    

    $strSQL = "UPDATE sis_student_info 
               SET 
               std_address = '$address', 
               std_tel = '$tel', 
               std_hm_address = '$hmaddress', 
               std_hm_tel = '$hmtel', 
               std_wk_address = '$wpaddress',
               std_wk_tel = '$wptel'
                WHERE std_id = '$username'";
    $resUpdate = $db->execute($strSQL);

    $strSQL = "UPDATE sis_userinfo SET EMAIL = '$email'
               WHERE USERNAME = '$username'";
    $resUpdate = $db->execute($strSQL);

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_student_immigration'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['username']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $cid = base64_encode(mysqli_real_escape_string($conn, $_POST['cid']));
    $cid_iss = mysqli_real_escape_string($conn, $_POST['cid_iss']);
    $cid_exp = mysqli_real_escape_string($conn, $_POST['cid_exp']);
    $visa = base64_encode(mysqli_real_escape_string($conn, $_POST['visa']));
    $visa_iss = mysqli_real_escape_string($conn, $_POST['visa_iss']);
    $visa_exp = mysqli_real_escape_string($conn, $_POST['visa_exp']);
    $passport = base64_encode(mysqli_real_escape_string($conn, $_POST['passport']));
    $passport_iss = mysqli_real_escape_string($conn, $_POST['passport_iss']);
    $passport_exp = mysqli_real_escape_string($conn, $_POST['passport_exp']);
    

    $strSQL = "UPDATE sis_student_info 
               SET 
               std_idcard = '$cid', 
               std_idcard_issue = '$cid_iss', 
               std_idcard_expire = '$cid_exp', 
               std_passport_id = '$passport', 
               std_passport_issue = '$passport_iss',
               std_passport_expire = '$passport_exp', 
               std_visa_id = '$visa', 
               std_visa_issue = '$visa_iss', 
               std_visa_expire = '$visa_exp'
                WHERE std_id = '$username'";
    $resUpdate = $db->execute($strSQL);
    
    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'get_note'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);

    $strSQL = "SELECT a.*, b.FNAME, b.LNAME FROM sis_studynote a INNER JOIN sis_userinfo b ON a.note_taker = b.USERNAME 
               WHERE a.note_student = '$std_id' AND b.USE_STATUS = 'Y' ORDER BY a.note_datetime DESC";
    $res = $db->fetch($strSQL, true, true);
    if(($res) && ($res['count'] > 0)){
        $return['status'] = 'Success';
        $return['data'] = $res['data'];
    }else{
        $return['status'] = 'Fail';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'deletenote'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['noteid']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $noteid = mysqli_real_escape_string($conn, $_POST['noteid']);
    
    $strSQL = "UPDATE sis_studynote SET note_delete = 'Y', note_dby = '$uid', note_ddatetime = '$datetime' WHERE note_id = '$noteid'";
    $res = $db->execute($strSQL);

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'save_note'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['msg']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);

    $strSQL = "INSERT INTO sis_studynote (`note_ip`, `note_datetime`, `note_message`, `note_student`, `note_taker`) 
               VALUES ('$ip', '$datetime', '$msg', '$std_id', '$uid')";
    $res = $db->insert($strSQL, false);
    if($res){
        $return['status'] = 'Success';
        $return['cmd'] = $strSQL;
    }else{
        $return['status'] = 'Fail';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'unmonitor'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);

    $strSQL = "UPDATE sis_student_info SET std_mon_status = 'N' WHERE std_id = '$std_id'";
    $res = $db->execute($strSQL);

    $return['cmd'] = $strSQL;
    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'setmonitor'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['to']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $to = mysqli_real_escape_string($conn, $_POST['to']);

    $strSQL = "UPDATE sis_student_info SET std_mon_status = '$to' WHERE std_id = '$std_id'";
    $res = $db->execute($strSQL);

    // $return['cmd'] = $strSQL;
    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();
}