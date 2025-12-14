<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$input = file_get_contents("php://input");

$data = json_decode($input/*, true*/);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($data->username == 'man123' && $data->password == '1234567') {
        echo json_encode(
            [
                "message" => "Wellcome back",
                "token" => "123"
            ]
        );
    } else {
        echo json_encode(["message" => "write a correct user or password"]);
    }

} else
    echo json_encode(["message" => "only request method is allowed"]);







?>