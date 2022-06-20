<?php 
require('../config/server.inc.php');
require('../config/config.php');
require('../config/database.php'); 

$db = new Database();
$conn = $db->conn();

require('../config/sendemail.php'); 


unset($_SESSION['doe_uid']);
unset($_SESSION['doe_sis_role']);
unset($_SESSION['doe_id']);
session_destroy();

$db->close();
header('Location: '.ROOT_DOMAIN);
die();

?>