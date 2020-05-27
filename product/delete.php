<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Headers, Authorization, X-Request-With");

include_once('../config/database.php');
include_once('../objects/product.php');

$product = getProductEssence();

$sendingData = json_encode(file_get_contents"php://input");

$product->id = $sendingData->id;

$this->serverResponse(delete(), "The product was successfully removed", "The product was not removed");