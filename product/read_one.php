<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-type: application/json");

include_once('../config/database.php');
include_once('../objects/product.php');

$product = getProductEssence();

// $database = new DATABASE();
// $db = $database->getConnection();

// $product = new PRODUCT($db);

$product->id = isset($_GET['id']) ? $_GET['id'] : die();

$product->getProduct();

if ($product->name != null) {
    $product_arr = [
        "id" => $response->id,
        "name" => $response->name,
        "price" => $response->price,
        "description" => $response->description,
        "category_id" => $response->category_id,
        "category_name" => $response->category_name
    ];

    http_response_code(200);

    echo json_encode($product_arr["id"]);
} else {
    http_response_code(404);

    echo json_encode(["messages" => "nothing were found by this id"], JSON_UNESCAPED_UNICODE);
}