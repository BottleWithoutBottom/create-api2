<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

include_once("../config/database.php");
include_once("../objects/category.php");

$category = getCategoryEssence();


$categoriesQuery = $category->getAllCategories();
$categoriesQueryCount = $categoriesQuery->rowCount();

if ($categoriesQueryCount > 0) {
    $categoriesArray = [];
    $categoriesArray["records"] = [];
    while ($row = $categoriesQuery->fetch()) {
        extract($row);

        $category_item = [
            'cat_id' => $cat_id,
            'cat_name' => $cat_name,
            'description' => $description,
        ];

        array_push($categoriesArray["records"], $category_item);
    }

    http_response_code(200);

    echo json_encode($categoriesArray["records"]);
} else {
    echo json_encode(["messages" => "The categories were not found."], JSON_UNESCAPED_UNICODE);
}