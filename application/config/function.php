<?php 
function insertLog($db, $ip, $datetime, $uid, $activity, $detail, $relate_uid){
    $strSQL = "INSERT INTO sis_log (`ip`, `datetime`, `uid`, `activity`, `detail`, `relate_id`) VALUES ('$ip', '$datetime', '$uid', '$activity', '$detail', '$relate_uid')";
    $resInsert = $db->insert($strSQL, false);
    if(!$resInsert){
        echo $strSQL;
    }
}
?>
