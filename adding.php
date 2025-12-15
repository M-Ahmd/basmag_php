<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Authorization, Accept");
header("Access-Control-Allow-Methods: OPTIONS, POST");
if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    http_response_code(200);
    exit();
}

$headers = getallheaders();


if ($headers['Authorization'] == null || $headers['Authorization'] != 'Bearer 123') {
    http_response_code(401);
    exit();
}

$input_normal = file_get_contents("php://input");

$input = json_decode($input_normal, true);

if (!isset($input['body']) || !isset($input['title'])) {
    http_response_code(400);
    exit();
}
$filename = 'todos.json';
$json_data = [];
if(file_exists($filename)){
    $row_data = file_get_contents($filename);
    $json_data = json_decode($row_data, true);
}
if(empty($json_data))
{
    $id = 1;
}
else 
{
    $last_todo = end($json_data);
    $id = $last_todo['id'] + 1;
}
$data_to_save = ['id' => $id, 'title' => $input['title'], 'body' => $input['body']
, 'is_done' => false];
$json_data[] = $data_to_save;
file_put_contents($filename, json_encode($json_data, JSON_PRETTY_PRINT));


echo json_encode(['message' => 'done']);

?>