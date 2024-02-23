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

require('../config/sendemail.php'); 

if(!isset($_REQUEST['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_REQUEST['stage']);
$return = array();

if($stage == 'update_level'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['target_std_id'])) ||
        (!isset($_REQUEST['target_status']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $target_std_id = mysqli_real_escape_string($conn, $_POST['target_std_id']);
    $target_status = mysqli_real_escape_string($conn, $_POST['target_status']);

    $strSQL = "UPDATE sis_study_level_stagement SET ssls_status = 'N' WHERE ssls_std = '$target_std_id'";
    $resUpdate = $db->execute($strSQL);

    $strSQL = "INSERT INTO sis_study_level_stagement (`ssls_std`, `ssls_level`, `ssls_udatetime`, `ssls_by`, `ssls_status`) VALUES ('$target_std_id', '$target_status', '$datetime', '$uid', 'Y')";
    $resInsert = $db->insert($strSQL, true);
    if($resInsert){ 
        $return['status'] = 'Success';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Can not update';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
}

if($stage == 'add_pub'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['title'])) ||
        (!isset($_REQUEST['pub_date'])) ||
        (!isset($_REQUEST['author'])) ||
        (!isset($_REQUEST['publisher']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $pub_date = mysqli_real_escape_string($conn, $_POST['pub_date']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);

    $strSQL= "INSERT INTO sis_pub 
             (
                `pub_title`, `pub_udatetime`, `pub_by_username`, `pub_publish_date`, `pub_publisher`, `pub_author`, `pe_student_username`
             )
             VALUES 
             (
                '$title', '$datetime', '$uid', '$pub_date', '$publisher', '$author', '$std_id'
             )
             ";
    $resInsert = $db->insert($strSQL, false);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){

        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_pub`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'add_pe'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['title'])) ||
        (!isset($_REQUEST['exam_date'])) ||
        (!isset($_REQUEST['exam_start'])) ||
        (!isset($_REQUEST['exam_end']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $exam_start = mysqli_real_escape_string($conn, $_POST['exam_start']);
    $exam_end = mysqli_real_escape_string($conn, $_POST['exam_end']);

    if($exam_date != ''){
        $exam_start = $exam_start.":00";
        $exam_end = $exam_end.":00";
    }

    $strSQL = "INSERT INTO sis_pe 
              (`pe_title`, `pe_udatetime`, `pe_by_username`, `pe_exam_schedule_date`, `pe_exam_time_start`, 
              `pe_exam_time_end`, `pe_student_username`) 
              VALUES 
              ( '$title', '$datetime', '$uid', '$exam_date', '$exam_start',  '$exam_end', '$std_id')";
    if($exam_date == ''){
        $strSQL = "INSERT INTO sis_pe 
              (`pe_title`, `pe_udatetime`, `pe_by_username`, `pe_student_username`) 
              VALUES 
              ( '$title', '$datetime', '$uid', '$std_id')";
    }

    $resInsert = $db->insert($strSQL, false);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_pe`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'add_ce'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['title'])) ||
        (!isset($_REQUEST['exam_date'])) ||
        (!isset($_REQUEST['exam_start'])) ||
        (!isset($_REQUEST['exam_end']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $exam_start = mysqli_real_escape_string($conn, $_POST['exam_start']);
    $exam_end = mysqli_real_escape_string($conn, $_POST['exam_end']);

    if($exam_date != ''){
        $exam_start = $exam_start.":00";
        $exam_end = $exam_end.":00";
    }

    $strSQL = "INSERT INTO sis_ce 
              (`ce_title`, `ce_udatetime`, `ce_by_username`, `ce_exam_schedule_date`, `ce_exam_time_start`, 
              `ce_exam_time_end`, `ce_student_username`) 
              VALUES 
              ( '$title', '$datetime', '$uid', '$exam_date', '$exam_start',  '$exam_end', '$std_id')";
    if($exam_date == ''){
        $strSQL = "INSERT INTO sis_ce 
              (`ce_title`, `ce_udatetime`, `ce_by_username`, `ce_student_username`) 
              VALUES 
              ( '$title', '$datetime', '$uid', '$std_id')";
    }

    $resInsert = $db->insert($strSQL, false);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_ce`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'add_te'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['title'])) ||
        (!isset($_REQUEST['exam_date'])) ||
        (!isset($_REQUEST['exam_start'])) ||
        (!isset($_REQUEST['exam_end']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $exam_start = mysqli_real_escape_string($conn, $_POST['exam_start']);
    $exam_end = mysqli_real_escape_string($conn, $_POST['exam_end']);

    if($exam_date != ''){
        $exam_start = $exam_start.":00";
        $exam_end = $exam_end.":00";
    }

    $strSQL = "INSERT INTO sis_te 
              (`te_title`, `te_udatetime`, `te_by_username`, `te_exam_schedule_date`, `te_exam_time_start`, 
              `te_exam_time_end`, `te_student_username`) 
              VALUES 
              ( '$title', '$datetime', '$uid', '$exam_date', '$exam_start',  '$exam_end', '$std_id')";
    if($exam_date == ''){
        $strSQL = "INSERT INTO sis_te 
              (`te_title`, `te_udatetime`, `te_by_username`, `te_student_username`) 
              VALUES 
              ( '$title', '$datetime', '$uid', '$std_id')";
    }

    $resInsert = $db->insert($strSQL, false);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_te`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'add_qe'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['title'])) ||
        (!isset($_REQUEST['exam_date'])) ||
        (!isset($_REQUEST['exam_start'])) ||
        (!isset($_REQUEST['exam_end']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $exam_start = mysqli_real_escape_string($conn, $_POST['exam_start']);
    $exam_end = mysqli_real_escape_string($conn, $_POST['exam_end']);

    if($exam_date != ''){
        $exam_start = $exam_start.":00";
        $exam_end = $exam_end.":00";
    }

    $strSQL = "INSERT INTO sis_qe 
              (`qe_title`, `qe_udatetime`, `qe_by_username`, `qe_exam_schedule_date`, `qe_exam_time_start`, 
              `qe_exam_time_end`, `qe_student_username`) 
              VALUES 
              ( '$title', '$datetime', '$uid', '$exam_date', '$exam_start',  '$exam_end', '$std_id')";
    if($exam_date == ''){
        $strSQL = "INSERT INTO sis_qe 
              (`qe_title`, `qe_udatetime`, `qe_by_username`, `qe_student_username`) 
              VALUES 
              ( '$title', '$datetime', '$uid', '$std_id')";
    }

    $resInsert = $db->insert($strSQL, false);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_qe`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'add_eng'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['exam_info'])) ||
        (!isset($_REQUEST['exam_name'])) ||
        (!isset($_REQUEST['exam_date']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $exam_info = mysqli_real_escape_string($conn, $_POST['exam_info']);
    $exam_name = mysqli_real_escape_string($conn, $_POST['exam_name']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);

    $strSQL = "INSERT INTO sis_eng (`eng_title`, `eng_info`, `eng_udatetime`, `eng_by_username`, `eng_exam_date`, `eng_student_username`) 
              VALUES 
              ( '$exam_name', '$exam_info', '$datetime', '$uid', '$exam_date', '$std_id')";
    if($exam_date == ''){
        $strSQL = "INSERT INTO sis_eng (`eng_title`, `eng_info`, `eng_udatetime`, `eng_by_username`,  `eng_student_username`)   VALUES ( '$exam_name', '$exam_info', '$datetime', '$uid', '$std_id')";
    }

    $resInsert = $db->insert($strSQL, false);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_eng`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_pe'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['progress_id'])) ||
        (!isset($_REQUEST['title'])) ||
        (!isset($_REQUEST['exam_date'])) ||
        (!isset($_REQUEST['exam_start'])) ||
        (!isset($_REQUEST['exam_end']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $progress_id = mysqli_real_escape_string($conn, $_POST['progress_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $exam_start = mysqli_real_escape_string($conn, $_POST['exam_start']);
    $exam_end = mysqli_real_escape_string($conn, $_POST['exam_end']);

    if($exam_date != ''){
        $exam_start = $exam_start.":00";
        $exam_end = $exam_end.":00";
    }

    $strSQL = "UPDATE sis_pe SET pe_title = '$title', pe_udatetime = '$datetime', pe_by_username = '$uid', pe_exam_schedule_date = '$exam_date', pe_exam_time_start = '$exam_start', pe_exam_time_end = '$exam_end' WHERE pe_id = '$progress_id'";

    if($exam_date == ''){
        $strSQL = "UPDATE sis_pe SET pe_title = '$title', pe_udatetime = '$datetime', pe_by_username = '$uid', pe_exam_schedule_date = NULL, pe_exam_time_start = NULL, pe_exam_time_end = NULL WHERE pe_id = '$progress_id'";
    }

    $resInsert = $db->execute($strSQL);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_pe`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_pub'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['progress_id'])) ||
        (!isset($_REQUEST['title'])) ||
        (!isset($_REQUEST['pub_date'])) ||
        (!isset($_REQUEST['author'])) ||
        (!isset($_REQUEST['publisher']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $progress_id = mysqli_real_escape_string($conn, $_POST['progress_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $pub_date = mysqli_real_escape_string($conn, $_POST['pub_date']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);


    $strSQL = "UPDATE sis_pub SET pub_title = '$title', pub_publish_date = '$pub_date', pub_publisher = '$publisher', pub_author = '$author', pub_by_username = '$uid'  WHERE pub_id = '$progress_id'";


    $resInsert = $db->execute($strSQL);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_pub`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_ce'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['progress_id'])) ||
        (!isset($_REQUEST['title'])) ||
        (!isset($_REQUEST['exam_date'])) ||
        (!isset($_REQUEST['exam_start'])) ||
        (!isset($_REQUEST['exam_end']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $progress_id = mysqli_real_escape_string($conn, $_POST['progress_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $exam_start = mysqli_real_escape_string($conn, $_POST['exam_start']);
    $exam_end = mysqli_real_escape_string($conn, $_POST['exam_end']);

    if($exam_date != ''){
        $exam_start = $exam_start.":00";
        $exam_end = $exam_end.":00";
    }

    $strSQL = "UPDATE sis_ce SET ce_title = '$title', ce_udatetime = '$datetime', ce_by_username = '$uid', ce_exam_schedule_date = '$exam_date', ce_exam_time_start = '$exam_start', ce_exam_time_end = '$exam_end' WHERE ce_id = '$progress_id'";

    if($exam_date == ''){
        $strSQL = "UPDATE sis_ce SET ce_title = '$title', ce_udatetime = '$datetime', ce_by_username = '$uid', ce_exam_schedule_date = NULL, ce_exam_time_start = NULL, ce_exam_time_end = NULL WHERE ce_id = '$progress_id'";
    }

    $resInsert = $db->execute($strSQL);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_ce`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_qe'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['std_id'])) ||
        (!isset($_REQUEST['progress_id'])) ||
        (!isset($_REQUEST['title'])) ||
        (!isset($_REQUEST['exam_date'])) ||
        (!isset($_REQUEST['exam_start'])) ||
        (!isset($_REQUEST['exam_end']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
    $progress_id = mysqli_real_escape_string($conn, $_POST['progress_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $exam_start = mysqli_real_escape_string($conn, $_POST['exam_start']);
    $exam_end = mysqli_real_escape_string($conn, $_POST['exam_end']);

    if($exam_date != ''){
        $exam_start = $exam_start.":00";
        $exam_end = $exam_end.":00";
    }

    $strSQL = "UPDATE sis_qe SET qe_title = '$title', qe_udatetime = '$datetime', qe_by_username = '$uid', qe_exam_schedule_date = '$exam_date', qe_exam_time_start = '$exam_start', qe_exam_time_end = '$exam_end' WHERE qe_id = '$progress_id'";

    if($exam_date == ''){
        $strSQL = "UPDATE sis_qe SET qe_title = '$title', qe_udatetime = '$datetime', qe_by_username = '$uid', qpe_exam_schedule_date = NULL, qe_exam_time_start = NULL, qe_exam_time_end = NULL WHERE qe_id = '$progress_id'";
    }

    $resInsert = $db->execute($strSQL);
    if($resInsert){

        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_qe`, `sp_udatetime`) VALUES ('$std_id', 'waiting', '$datetime')";
            $db->insert($strSQL, false);
        }

        $return['status'] = 'Success';
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1002';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'delete_progress'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['progress'])) ||
        (!isset($_REQUEST['progress_id']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $progress = mysqli_real_escape_string($conn, $_POST['progress']);
    $progress_id = mysqli_real_escape_string($conn, $_POST['progress_id']);

    if($progress == 'pe'){
        $strSQL = "UPDATE sis_pe SET pe_status = 'N' WHERE pe_id = '$progress_id'";
        $resUpdate = $db->execute($strSQL);
        $return['status'] = 'Success';
    }

    if($progress == 'qe'){
        $strSQL = "UPDATE sis_qe SET qe_status = 'N' WHERE qe_id = '$progress_id'";
        $resUpdate = $db->execute($strSQL);
        $return['status'] = 'Success';
    }

    if($progress == 'eng'){
        $strSQL = "UPDATE sis_eng SET eng_status = 'N' WHERE eng_id = '$progress_id'";
        $resUpdate = $db->execute($strSQL);
        $return['status'] = 'Success';
    }

    if($progress == 'pub'){
        $strSQL = "UPDATE sis_pub SET pub_status = 'N' WHERE pub_id = '$progress_id'";
        $resUpdate = $db->execute($strSQL);
        $return['status'] = 'Success';
    }

    if($progress == 'ce'){
        $strSQL = "UPDATE sis_ce SET ce_status = 'N' WHERE ce_id = '$progress_id'";
        $resUpdate = $db->execute($strSQL);
        $return['status'] = 'Success';
    }

    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_status'){
    if(
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['progress'])) ||
        (!isset($_REQUEST['status'])) || 
        (!isset($_REQUEST['pass_date'])) || 
        (!isset($_REQUEST['std_id'])) 
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $progress = mysqli_real_escape_string($conn, $_POST['progress']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $pass_date = mysqli_real_escape_string($conn, $_POST['pass_date']);
    $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);

    if($progress == 'pe'){
        
        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
            $strSQL = "UPDATE sis_student_progress SET sp_pe = '$status', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
            $db->execute($strSQL);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_pe_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_pe_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }

            $return['status'] = 'Success';
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_pe`, `sp_udatetime`) VALUES ('$std_id', '$status', '$datetime')";
            $db->insert($strSQL, false);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_pe_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_pe_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }
            $return['status'] = 'Success';
        }

    }

    if($progress == 'qe'){
        
        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
            $strSQL = "UPDATE sis_student_progress SET sp_qe = '$status', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
            $db->execute($strSQL);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_qe_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_qe_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }

            $return['status'] = 'Success';
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_qe`, `sp_udatetime`) VALUES ('$std_id', '$status', '$datetime')";
            $db->insert($strSQL, false);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_qe_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_qe_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }
            $return['status'] = 'Success';
        }
    }

    if($progress == 'ec'){
        
        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
            $strSQL = "UPDATE sis_student_progress SET sp_ec = '$status', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
            $db->execute($strSQL);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_ec_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_ec_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }

            $return['status'] = 'Success';
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_ec`, `sp_udatetime`) VALUES ('$std_id', '$status', '$datetime')";
            $db->insert($strSQL, false);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_ec_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_ec_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }
            $return['status'] = 'Success';
        }
    }

    if($progress == 'eng'){
        
        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
            $strSQL = "UPDATE sis_student_progress SET sp_eng = '$status', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
            $db->execute($strSQL);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_eng_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_eng_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }

            $return['status'] = 'Success';
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_eng`, `sp_udatetime`) VALUES ('$std_id', '$status', '$datetime')";
            $db->insert($strSQL, false);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_eng_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_eng_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }
            $return['status'] = 'Success';
        }
    }

    if($progress == 'ce'){
        
        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
            $strSQL = "UPDATE sis_student_progress SET sp_ce = '$status', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
            $db->execute($strSQL);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_ce_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_ce_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }

            $return['status'] = 'Success';
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_ce`, `sp_udatetime`) VALUES ('$std_id', '$status', '$datetime')";
            $db->insert($strSQL, false);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_ce_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_ce_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }
            $return['status'] = 'Success';
        }
    }


    if($progress == 'pub'){
        
        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
            $strSQL = "UPDATE sis_student_progress SET sp_pub = '$status', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
            $db->execute($strSQL);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_pub_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_pub_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }

            $return['status'] = 'Success';
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_pub`, `sp_udatetime`) VALUES ('$std_id', '$status', '$datetime')";
            $db->insert($strSQL, false);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_pub_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_pub_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }
            $return['status'] = 'Success';
        }
    }

    if($progress == 'te'){
        
        $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$std_id'";
        $resCheck = $db->fetch($strSQL, false, false);
        if($resCheck){
            $strSQL = "UPDATE sis_student_progress SET sp_te = '$status', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
            $db->execute($strSQL);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_te_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_te_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }

            $return['status'] = 'Success';
        }else{
            $strSQL = "INSERT INTO sis_student_progress (`sp_std_id`, `sp_te`, `sp_udatetime`) VALUES ('$std_id', '$status', '$datetime')";
            $db->insert($strSQL, false);

            if($status == 'pass'){
                $strSQL = "UPDATE sis_student_progress SET sp_te_passdate = '$pass_date', sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }else{
                $strSQL = "UPDATE sis_student_progress SET sp_te_passdate = NULL, sp_udatetime = '$datetime' WHERE sp_std_id = '$std_id'";
                $db->execute($strSQL);
            }
            $return['status'] = 'Success';
        }
    }

    echo json_encode($return);
    mysqli_close($conn);
    die();
}