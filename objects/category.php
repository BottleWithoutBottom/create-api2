<?php

class Category {
    private $connection;
    private $table_name = "categories";

    public $cat_id;
    public $cat_name;
    public $description;
    public $cat_created;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function serverResponse($method, $correct, $incorrect) {
        if ($product->$method) {
            http_response_code(200);

            echo json_encode(["messages" => $correct], JSON_UNESCAPED_UNCIODE);
        } else {
            http_response_code(503);

            echo json_encode(["messages" => $incorrect], JSON_UNESCAPED_UNICODE);
        }
    }

    public function getAllCategories() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY cat_name";

        $preparedQuery = $this->connection->prepare($query);
        $preparedQuery->execute();

        return $preparedQuery;
    }
}

function getCategoryEssence() {
    $database = new DATABASE();

    $db = $database->getConnection();

    return $category = new Category($db);    
}