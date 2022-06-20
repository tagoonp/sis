<?php 
require('../config/server.inc.php');
require('../config/config.php');
require('../config/database.php'); 

$db = new Database();
$conn = $db->conn();

if(!isset($_REQUEST['to'])){
  mysqli_close($conn);
  header('Location: ../html/core/login/');
  die();
}



require('../config/sendemail.php'); 

$to = mysqli_real_escape_string($conn, $_REQUEST['to']);

$_SESSION['doe_sis_role'] = $to;

$db->close();
header('Location: ../html/core/system/');       
die();