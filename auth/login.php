<?php

header("Access-Control-Allow-Origin: http://authentication-jwt/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Headers, Authorization, X-Request-With");

include_once('../config/database.php');
include_once('../objects/user.php');

$user = getUserEssense();

$receivedData = json_decode(file_get_contents('php://input'));
var_dump($receivedData);
$user->email = $receivedData->email;
var_dump($user->email);
$email_exists = $user->checkEmail();
var_dump($email_exists);