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

    $strSQL = "SELECT a.*, b.FNAME, b.LNAME FROM sis_studynote a INNER JOIN sis_userinfo b ON a.note_taker = b.USERNAME WHERE a.note_student = '$std_id' ORDER BY a.note_datetime DESC";
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