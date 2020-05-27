<?php

header("Access-Control-Allow-Origin: http://authentication-jwt/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once('../config/database.php');
include_once('../objects/user.php');
$data = json_decode(file_get_contents("php://input"));

$user = getUserEssense();
var_dump($data);
$user->user_name = $data->user_name;
$user->user_phone = $data->user_phone;
$user->password = $data->password;
$user->email = $data->email;
if (
    !empty($user->user_name) &&
    !empty($user->user_phone)  ||
    !empty($user->email) &&
    !empty($user->password)
) {
    $user->addUser();

    http_response_code(200);

   echo json_encode(["messages" => "User was created successfully."]);
} else {
    http_response_code(400);

    echo json_encode(["messages" => "Some data is wrong. Fix it"]);
}