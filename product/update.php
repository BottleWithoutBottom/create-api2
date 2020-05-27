<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-type, Access-Control-Headers, Authorization, X-Request-With");

include_once("../config/database.php");
include_once("../objects/product.php");

$product = getProductEssence();

$editData = json_encode(file_get_contents("php://input"));

$product->id = $editData->id;

$product->name = $editData->name;
$product->price = $editData->price;
$product->description = $editData->description;
$product->category_id = $editData->category_id;

$product->serverResponse(editProduct(), "This product was edited", "This product was not edited");