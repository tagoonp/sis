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

if($stage == 'create'){
    if(
        (!isset($_REQUEST['appname'])) ||
        (!isset($_REQUEST['email'])) ||
        (!isset($_REQUEST['callback']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $appname = mysqli_real_escape_string($conn, $_POST['appname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $callback = mysqli_real_escape_string($conn, $_POST['callback']);
    $key = generateRandomString(29);

    $strSQL = "INSERT INTO mym_credential (`cre_app`, `cre_callback`, `cre_email`, `cre_status`, `cre_cdatetime`, `cre_api`)
               VALUES ('$appname', '$callback', '$email', '1', '$datetime', '$key')
               ";
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