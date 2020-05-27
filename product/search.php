<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('../config/core.php');
include_once('../config/database.php');
include_once('../objects/product.php');

$product = getProductEssence();
$keywords = isset($_GET["s"]) ? $_GET["s"] : '';
$foundProducts = $product->searchProduct($keywords);
$foundProductsQuan = $foundProducts->rowCount();
var_dump($foundProductsQuan);
if ($foundProductsQuan > 0) {
    $products_arr = [];
    $products_arr["records"] = [];

    while($row = $foundProducts->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item = [
            "id" => $id,
            "price" => $price,
            "name" => $name,
            "description" => $description,
            "category_id" => $category_id,
            "cat_name" => $cat_name
        ];

        array_push($products_arr["records"], $product_item);
    }

    http_response_code(200);

    echo json_encode($products_arr);
} else {
    http_response_code(404);

    echo json_encode(["messages" => "Nothing were found."], JSON_UNESCAPED_UNICODE);
}