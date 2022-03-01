<?php 
require('../config/server.inc.php');
require('../config/config.php');
require('../config/database.php'); 

if((!isset($_REQUEST['uid'])) || (!isset($_REQUEST['token']))){
  mysqli_close($conn);
  header('Location: ../html/core/login/');
  die();
}

$db = new Database();
$conn = $db->conn();

require('../config/sendemail.php'); 

$uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
$token = mysqli_real_escape_string($conn, $_REQUEST['token']);

$_SESSION['doe_uid'] = $uid;
$_SESSION['doe_token'] = $token;
$_SESSION['doe_id'] = session_id();

$strSQL = "SELECT * FROM sis_account a INNER JOIN sis_userinfo b ON a.UID = b.UID WHERE a.UID = '$uid' AND a.ACTIVE_STATUS = 'Y' AND b.USE_STATUS = 'Y' ORDER BY b.ID DESC LIMIT 1";
$res = $db->fetch($strSQL, false, false);

if($res){
  // $email = $res['email'];
  // $title = "[RMIS] แจ้งเตือนการเข้าใช้งานระบบ";
  // $content = '<p>เรียน คุณ'.$res['fname']." ".$res['lname'].'</p>';
  // $content .= '<p>ท่านได้ทำการล๊อคอินเข้าใช้งานระบบ RMIS ผ่าน IP Address '.$ip.' หากนี่ไม่ใช่กิจกรรมของท่าน กรุณาติดต่อเจ้าน้าที่เพื่อตรวจสอบข้อมูลและดำเนินการต่อไป</p>';
  // $content .= '<p>จึงเรียนมาเพื่อทราบ หากมีข้อสงสัยกรุณาโทรติดต่อสำนักงาน</p>';
  // $content .= '<p>ด้วยความเคารพอย่างสูง</p>';
  // sendEmail($db, 'แจ้งเตือนการเข้าใช้งานระบบ', '', '', $uid, $email, "แจ้งเตือนการเข้าใช้งานระบบ", $content, '');

  header('Location: '.ROOT_DOMAIN.'html/core/'.$res['ROLE'].'/');
}else{
  echo $strSQL;
  // header('Location: ../html/core/login/');
}

$db->close();
die();




?>