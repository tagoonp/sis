<?php
require('../config/server.inc.php');
require('../config/config.php');
require('../config/database.php'); 

// die();
// Access Token
$access_token = LINE_MESSAGE_TOKEN;
// User ID
$userId = 'U9839ec7632ba4fb5322be7aa0a341bf5';

// ข้อความที่ต้องการส่ง
$messages = array(
    'type' => 'text',
    'text' => 'มีผู้ใช้งานสมัตรใช้งานระบบ',
);
$post = json_encode(array(
    'to' => array($userId),
    'messages' => array($messages),
));
// URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
$url = 'https://api.line.me/v2/bot/message/multicast';
$headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
echo $result;