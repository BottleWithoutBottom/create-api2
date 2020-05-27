<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('../config/database.php');
include_once('../objects/product.php');

$product = getProductEssence();
// $database = new DATABASE();
// $db = $database->getConnection();

// $product = new PRODUCT($db);


$products = $product->getProducts();

$productsQuantity = $products->rowCount();

if ($productsQuantity > 0) {
    $products_arr = [];
    $products_arr["records"] = [];

    while($productROW = $products->fetch(PDO::FETCH_ASSOC)) {

        extract($productROW);

        $product_item = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $category_id,
            'category_name' => $cat_name
        ];

        array_push($products_arr["records"], $product_item);
    }
    http_response_code(200);

    echo json_encode($products_arr["records"]);
} else {
    http_response_code(404);

    echo json_encode(["message" => "Products were not found"] . JSON_UNESCAPED_UNICODE);
}
?>



