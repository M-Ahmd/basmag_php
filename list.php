<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Accept, Authorization"); // ضيفنا ده عشان الأمان

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}
$headers = getallheaders();
$token = null;
 
if(isset($headers['Authorization'])) {
    $token = $headers['Authorization'];
} elseif (isset($headers['authorization'])) {
    $token = $headers['authorization'];
}

if($token == null || $token !== 'Bearer 123')
{
    http_response_code(404);
    exit();
}

$filename = 'todos.json';

if (file_exists($filename)) {
    // 1. الصح: نستخدم file_get_contents عشان نخزن النص في متغير
    $content = file_get_contents($filename);
    
    // 2. نطبع النص
    echo $content;
} else {
    echo json_encode([]);
}
?>