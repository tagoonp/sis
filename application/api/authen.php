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

if(!isset($_REQUEST['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_REQUEST['stage']);

if($stage == 'create_session'){
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

    if($config_department_id != $dept_id){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo "Invalid parameters<br>";
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $strSQL = "SELECT * FROM sis_account a INNER JOIN sis_userinfo b ON a.USERNAME = b.USERNAME WHERE a.ACTIVE_STATUS = 'Y' AND a.DELETE_STATUS = 'N' AND b.USE_STATUS = 'Y' AND a.USERNAME = '$uid'";
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
        header('Location: ../html/core/system/');       

        die();

    }else{
        $db->close();
        header('Location: ../html/core/auth/register?uid='.$uid.'&name='.$name.'&surname='.$surname.'&dept='.$dept.'&dept_id='.$dept_id.'&position='.$position.'&stdid='.$stdid.'&email='.$email);        
        die();
    }
}

if($stage == 'medipe_authen'){
    if(
        (!isset($_REQUEST['token'])) ||
        (!isset($_REQUEST['pid'])) ||
        (!isset($_REQUEST['username'])) ||
        (!isset($_REQUEST['profile'])) || 
        (!isset($_REQUEST['email'])) || 
        (!isset($_REQUEST['uid'])) 
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $token = mysqli_real_escape_string($conn, $_REQUEST['token']);
    $pid = mysqli_real_escape_string($conn, $_REQUEST['pid']);
    $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
    $profile = mysqli_real_escape_string($conn, $_REQUEST['profile']);
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);

    // echo $uid. "<br>";
    // echo $token. "<br>";
    // echo $pid. "<br>";
    // echo $username. "<br>";
    // echo $profile. "<br>";
    // echo $email. "<br>";

    // die();

    $strSQL = "SELECT * FROM sis_account a INNER JOIN sis_userinfo b ON a.USERNAME = b.USERNAME 
               WHERE 
               a.ACTIVE_STATUS = 'Y' 
               AND a.DELETE_STATUS = 'N' 
               AND b.USE_STATUS = 'Y' 
               AND a.USERNAME = '$username'
               ";
    $res = $db->fetch($strSQL, false, false);
    if($res){

        if($res['LINE_TOKEN'] == null){
            $strSQL = "UPDATE sis_account SET LINE_TOKEN = '$token' WHERE USERNAME = '$username'";
            $resUpdate = $db->execute($strSQL);
        }

        $_SESSION['doe_uid'] = $username; // username

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
        header('Location: ../html/core/system/');       

        die();

    }else{
        echo "Permission denine, please contact system administrator";
        $db->close();
        die();
    }

}

if($stage == 'updatecontact'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['sid'])) ||
        (!isset($_REQUEST['phone'])) ||
        (!isset($_REQUEST['office'])) 
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
    $sid = mysqli_real_escape_string($conn, $_REQUEST['sid']);
    $phone = mysqli_real_escape_string($conn, $_REQUEST['phone']);
    $office = mysqli_real_escape_string($conn, $_REQUEST['office']);
    $address = mysqli_real_escape_string($conn, $_REQUEST['address']);
    $fax = mysqli_real_escape_string($conn, $_REQUEST['fax']);

    $strSQL = "UPDATE userinfo
               SET 
               address = '$address',
               tel_mobile = '$phone',
               tel_office = '$office',
               tel_fax = '$fax'
               WHERE 
               user_id = '$uid'
              ";
    $res = $db->execute($strSQL);

    $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('Update contact', '$ip', '$datetime', '$uid')";
    $res = $db->execute($strSQL);
    
    $strSQL = "SELECT email FROM useraccount WHERE id = '$uid'";
    $resUser = $db->fetch($strSQL, false, false);
    if($resUser){
        $email = $resUser['email'];
        $title = "[RMIS] แจ้งเตือนการแก้ไขข้อมูลการติดต่อ";
        $content = '<p>เรียน นักวิจัยที่นับถือ</p>';
        $content .= '<p>เนื่องด้วยท่านได้ทำการปรับปรุงข้อมูลการติดต่อของท่านภายในระบบ RMIS ระบบจึงทำการแจ้งเตือนมายังอีเมลฉบับนี้เพื่อแจ้งให้ท่านทราบ และหากการดำเนินการนี้ไม่ได้เกิดการตัวท่าน กรุณาตรวจสอบและดำเนินการแจ้งเจ้าหน้าที่ต่อไป</p>';
        $content .= '<p>จึงเรียนมาเพื่อทราบ หากมีข้อสงสัยกรุณาโทรติดต่อสำนักงาน</p>';
        $content .= '<p>ด้วยความเคารพอย่างสูง</p>';
        sendEmail($db, 'นักวิจัยแก้ไขข้อมูลการติดต่อ', $sid, '', $uid, $email, "นักวิจัยแก้ไขข้อมูลการติดต่อ", $content, '');
    }   

    $return['status'] = 'Success';
    echo json_encode($return);
    mysqli_close($conn);
    die();

}