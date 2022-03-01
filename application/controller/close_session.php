<?php 
require('../config/server.inc.php');
require('../config/config.php');
require('../config/database.php'); 

$db = new Database();
$conn = $db->conn();

require('../config/sendemail.php'); 

$uid = mysqli_real_escape_string($conn, $_SESSION['doe_uid']);
$token = mysqli_real_escape_string($conn, $_SESSION['doe_token']);

$strSQL = "UPDATE access_token SET tk_timeout = 'Y' WHERE tk_uid = '$uid'";
$db->execute($strSQL);

// $strSQL = "INSERT INTO mym_log (`ip`, `datetime`, `uid`, `activity`, `detail`)
//            VALUES ('$ip', '$datetime', '$uid', 'Log out', '')
//           ";
// $db->insert($strSQL, false, false);

unset($_SESSION['doe_uid']);
unset($_SESSION['doe_token']);
unset($_SESSION['doe_id']);
session_destroy();

$db->close();
header('Location: '.ROOT_DOMAIN);
die();

?>