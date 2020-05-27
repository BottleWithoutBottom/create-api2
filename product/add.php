<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../config/database.php');
include_once('../objects/product.php');

$database = new DATABASE();
$db = $database->getConnection();

$product = new PRODUCT($db);

$sendingData = json_decode(file_get_contents("php://input"));

if (
    !empty($sendingData->name) &&
    !empty($sendingData->price) &&
    !empty($sendingData->description) &&
    !empty($sendingData->category_id)
) {
    $product->name = $sendingData->name;
    $product->price = $sendingData->price;
    $product->description = $sendingData->description;
    $product->category_id = $sendingData->category_id;
    $product->created = data('Y-m-d H:i:s');

    $this->serverResponse(addProduct(), "The product was added", "The product was not added");
} else {
    http_response_code(400);
    
    echo json_encode(["message" => "Some fields were not filled in correctly"]);
}