<?php 

if((!isset($_SESSION['doe_id'])) || ($_SESSION['doe_id'] != session_id())){
    $db->close();
    header('Location: ' . BASE_DIR);
}



?>