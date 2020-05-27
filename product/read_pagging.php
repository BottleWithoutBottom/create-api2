<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

include_once('../config/core.php');
include_once('../shared/utilities.php');
include_once('../config/database.php');
include_once('../objects/product.php');

$Util = new UTILITIES();


$product = getProductEssence();

$packOfProducts = $product->readPagging($max_on_page_num, $items_on_page);

$packOfProductsQuant = $packOfProducts->rowCount();


if ($packOfProductsQuant > 0) {
    $products_array = [];
    $products_array["records"] = [];
    $products_array["pagging"] = [];

    while ($row = $packOfProducts->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item = [
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "category_id" => $category_id,
            "cat_name" => $cat_name
        ];

        array_push($products_array["records"], $product_item);
    }

    $total_rows = $product->paggingCount();

    $page_url = "{$base_url}product/read_pagging.php?";
    $pagging = $Util->getPagging($page, $total_rows, $items_on_page, $page_url);
    $products_array["pagging"] = $pagging;
    http_response_code(200);
    echo json_encode($products_array);
} else {
    http_response_code(404);

    echo json_encode(["messages" => "The products were not found :( ", JSON_UNESCAPED_UNICODE]);
}