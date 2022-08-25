<?php

    include_once("jwt.php");
    $jwt = new jwt();

    //ใส่ secret key ที่ได้จากฝ่ายเทคโนโลยีสารสนเทศ
    //โทร. 1950 ติดต่อ ไชยยันต์ หรือ ปฐมฤกษ์
    //Test ใน 127.0.0.1 หรือ localhost ให้ใส่ .
    $jwt->secret = '.';


    if(isset($_GET['response'])){
        $response = $_GET['response'];

        $user_data = $jwt->decode($response);
        $manage = json_decode($user_data, true);
        print_r($manage);

        // $return_string = '../passport?uid='.$manage['uid'];
        $return_string = '../../../application/api/authen?stage=create_session&uid='.$manage['uid'].'&name='.$manage['name'].'&surname='.$manage['surname'].'&dept='.$manage['department'].'&dept_id='.$manage['departmentId'].'&position='.$manage['position'].'&stdid='.$manage['studentId'].'&email='.$manage['email'];
        // $return_string .= '&name='.$manage['name'];
        // $return_string .= '&surname='.$manage['surname'];
        // $return_string .= '&dept='.$manage['department'];
        // $return_string .= '&dept_id='.$manage['departmentId'];
        // $return_string .= '&position='.$manage['position'];
        // $return_string .= '&stdid='.$manage['studentId'];
        // $return_string .= '&email='.$manage['email'];


        // header('Location: ../passport?uid='.$manage['uid'].'&name='.$manage['name'].'&surname='.$manage['surname'].'&dept='.$manage['department'].'&dept_id='.$manage['departmentId'].'&position='.$manage['position'].'&stdid='.$manage['studentId'].'&email='.$manage['email']);
        header('Location: ' . $return_string);
        die();
    }

    // if(isset($_COOKIE['access_token'])){
    //     $response = $_COOKIE['access_token'];
    //     $user_data = $jwt->decode($_COOKIE['access_token']);
    //     print_r($user_data);
    // }

    // if(isset($_SESSION['uid'])){
    //     $uid = $_SESSION['uid'];
    //     echo "รหัสผู้ใช้งาน : $uid";
    // }

?>