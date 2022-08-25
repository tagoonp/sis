<?php 

if((!isset($_SESSION['doe_id'])) || ($_SESSION['doe_id'] != session_id())){
    $db->close();
    header('Location: ' . BASE_DIR);
}
// $_SESSION['doe_uid'] = $uid; // username

// if($res['ROLE_ADMIN'] == 'Y'){
//     $_SESSION['doe_sis_role'] = 'admin';
// }else{
//     if($res['ROLE_STAFF'] == 'Y'){
//         $_SESSION['doe_sis_role'] = 'staff';
//     }else{
//         if($res['ROLE_LECTURER'] == 'Y'){
//             $_SESSION['doe_sis_role'] = 'lecturer';
//         }else{
//             $_SESSION['doe_sis_role'] = 'student';
//         }
//     }
// }




?>