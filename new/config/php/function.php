<?php 
function insertLog($db, $ip, $datetime, $uid, $activity, $detail, $relate_uid){
    $strSQL = "INSERT INTO sis_log (`ip`, `datetime`, `uid`, `activity`, `detail`, `relate_id`) VALUES ('$ip', '$datetime', '$uid', '$activity', '$detail', '$relate_uid')";
    $resInsert = $db->insert($strSQL, false);
    if(!$resInsert){
        echo $strSQL;
    }
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
