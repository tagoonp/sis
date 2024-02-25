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

// require('../config/sendemail.php'); 
require("../vendor/autoload.php");

if(!isset($_REQUEST['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_REQUEST['stage']);
$return = array();

if($stage == 'send_message'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['message'])) ||
        (!isset($_REQUEST['to_id'])) || 
        (!isset($_REQUEST['to_token'])) 
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $to_id = mysqli_real_escape_string($conn, $_POST['to_id']);
    $to_token = mysqli_real_escape_string($conn, $_POST['to_token']);

    $access_token = LINE_MESSAGE_TOKEN;
    $line_key_array[] = $to_token;
    
    // ข้อความที่ต้องการส่ง
    $messages = array(
        'type' => 'text',
        'text' => $message ,
    );
    $post = json_encode(array(
        'to' => $line_key_array,
        'messages' => array($messages),
    ));

    // URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
    $url = 'https://api.line.me/v2/bot/message/multicast';
    $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);

    echo $result;
}

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

    $academic_year = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $s_date = mysqli_real_escape_string($conn, $_POST['s_date']);
    $s_month = mysqli_real_escape_string($conn, $_POST['s_month']);
    $s_year = mysqli_real_escape_string($conn, $_POST['s_year']);

    if($s_date < 10){ $s_date = "0".$s_date; };
    if($s_month < 10){ $s_month = "0".$s_month; };

    $set_date = $s_year . "-" . $s_month . "-" . $s_date;

    $strSQL = "UPDATE sis_student_info SET std_study_status = '$status', std_grad_year = NULL, std_grad_date = NULL, std_retired_date = NULL WHERE std_id = '$student_id'";

    if($status == 'graduated'){
        $strSQL = "UPDATE sis_student_info SET std_study_status = '$status', std_grad_year = '$academic_year', std_grad_date = '$set_date', std_retired_date = NULL WHERE std_id = '$student_id'";
    }

    if($status == 'retired'){
        $strSQL = "UPDATE sis_student_info SET std_study_status = '$status', std_grad_year = NULL, std_retired_year = '$academic_year', std_retired_date = '$set_date', std_grad_date = NULL WHERE std_id = '$student_id'";
    }

    // $strSQL = "UPDATE sis_student_info SET std_study_status = '$status',  WHERE std_id = '$student_id'";
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

if($stage == 'update_funding'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['fund'])) ||
        (!isset($_REQUEST['fund_other'])) || 
        (!isset($_REQUEST['fund_condifion']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $fund = mysqli_real_escape_string($conn, $_POST['fund']);
    $fund_other = mysqli_real_escape_string($conn, $_POST['fund_other']);
    $fund_condifion = mysqli_real_escape_string($conn, $_POST['fund_condifion']);

    $strSQL = "SELECT 1 FROM sis_student_info WHERE std_id = '$std_id' AND std_delete = 'N'";
    $res = $db->fetch($strSQL, false, false);
    if($res){
        $strSQL = "UPDATE sis_student_info SET std_fund = '$fund', std_fund_info = '$fund_other', std_fund_condition = '$fund_condifion' WHERE std_id = '$std_id' AND std_delete = 'N'";
        $resUpdate = $db->execute($strSQL);

        $return['status'] = 'Success';
        echo json_encode($return); mysqli_close($conn); die(); 
        
    }else{
        $return['status'] = 'Fail'; $return['err_message'] = 'Not found';
        echo json_encode($return); mysqli_close($conn); die(); 
    }


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

if($stage == 'update_student_profile'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['username'])) ||
        (!isset($_REQUEST['contry'])) ||
        (!isset($_REQUEST['fname'])) ||
        (!isset($_REQUEST['lname'])) ||
        (!isset($_REQUEST['syear'])) ||
        (!isset($_REQUEST['ssdate'])) ||
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
    $syear = mysqli_real_escape_string($conn, $_POST['syear']);
    $ssdate = mysqli_real_escape_string($conn, $_POST['ssdate']);

    $strSQL = "UPDATE sis_student_info SET std_country = '$country', std_start_year = '$syear', std_start_edu_date = '$ssdate', std_set_start_year = '$ssdate' WHERE std_id = '$username'";
    $resUpdate = $db->execute($strSQL);

    $strSQL = "UPDATE sis_userinfo SET PREFIX = '$prefix', FNAME = '$fname', MNAME = '$mname', LNAME = '$lname' WHERE USERNAME = '$username'";
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

if($stage == 'update_ec_info'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['submit_date'])) ||
        (!isset($_REQUEST['approve_date'])) ||
        (!isset($_REQUEST['expire_date'])) ||
        (!isset($_REQUEST['rec']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $submit_date = mysqli_real_escape_string($conn, $_POST['submit_date']);
    $approve_date = mysqli_real_escape_string($conn, $_POST['approve_date']);
    $expire_date = mysqli_real_escape_string($conn, $_POST['expire_date']);
    $rec = mysqli_real_escape_string($conn, $_POST['rec']);

    $strSQL = "UPDATE sis_ec SET ec_status = 'N' WHERE ec_std_id = '$std_id'";
    $resUpdate = $db->execute($strSQL);

    $strSQL = "INSERT INTO sis_ec (`ec_std_id`, `ec_first_submit_date`, `ec_rec`, `ec_approve`, `ec_expire`, `ec_udatetime`) VALUES ('$std_id', '$submit_date', '$rec', '$approve_date', '$expire_date', '$datetime')";
    $resInsert = $db->insert($strSQL, false);
    if($resInsert){
        $return['status'] = 'Success';
        echo json_encode($return);  mysqli_close($conn); die();
    }else{
        $return['status'] = 'Fail'; $return['error_code'] = 'Error';
        echo json_encode($return);  mysqli_close($conn); die();
    }
    
}

if($stage == 'update_ec_note'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['note']))
      ){
        $return['status'] = 'Fail';
        $return['code'] = 'x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $note = mysqli_real_escape_string($conn, $_POST['note']);

    $strSQL = "INSERT INTO sis_ec_note (`ecn_std_id`, `ecn_udatetime`, `ecn_by`, `ecn_note`) VALUES ('$std_id', '$datetime', '$uid', '$note')";
    $resInsert = $db->insert($strSQL, false);
    $return['status'] = 'Success';
    echo json_encode($return);  mysqli_close($conn); die();
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