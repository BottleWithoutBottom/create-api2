<?php

class PRODUCT {
    private $connection;
    private $table_name = 'products';

    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function clearProductFields(array $fields = []):bool {
        foreach ($fields as $field) {
            echo $this->$field;
            $this->$field = htmlspecialchars(strip_tags($this->field));
        }
        return true;
    }

    public function bindProductParams($preparedQuery, array $fields = []):bool {
        foreach($fields as $field) {
            $preparedQuery->bindParam('\':' . $field . '\'', $this->$field);
        }
        return true;
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

    public function getProducts() {
        $query = "SELECT * FROM $this->table_name LEFT JOIN categories ON category_id = cat_id";

        $preparedQuery = $this->connection->prepare($query);
        $preparedQuery->execute();
        return $preparedQuery;
    }



    public function addProduct() {
        $query = "INSERT INTO " . $table_name . "SET name=:name price=:price description=:description category_id=:category_id created=:created";
        $preparedQuery=$this->connection->prepare($query);

        $fields = ['name', 'price', 'description', 'category_id', 'created'];
        $this->clearProductFields($fields);
        // $this->name = htmlspecialchars(strip_tags($this->name));
        // $this->price = htmlspecialchars(strip_tags($this->price));
        // $this->description = htmlspecialchars(strip_tags($this->description));
        // $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        // $this->created = htmlspecialchars(strip_tags($this->created));

        $masksFields = ['name', 'price', 'description', 'category_id', 'created'];
        $this->bindProductParams($preparedQuery, $masksFields);
        // $preparedQuery->bindParam(":name", $this->name);
        // $preparedQuery->bindParam(":price", $this->price);
        // $preparedQuery->bindParam(":description", $this->description);
        // $preparedQuery->bindParam(":category_id", $this->category_id);
        // $preparedQuery->bindParam(":creaed", $this->created);
        if ($preparedQuery->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getProduct() {
        $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN categories ON category_id = cat_id WHERE id = ?";
        $preparedQuery = $this->connection->prepare($query);
        $preparedQuery->bindParam(1, $this->id);

        $preparedQuery->execute();

        $response = $preparedQuery->fetch(PDO::FETCH_ASSOC);
        var_dump($response);die();
        $this->name = $response['name'];
        $this->price = $response['price'];
        $this->description = $response['description'];
        $this->category_id = $response['category_id'];
        $this->category_name = $response['category_name'];
    }

    public function editProduct():bool {
        $query = "UPDATE " . $this->table_name . " SET name = :name, price = :price, description = :description, category_id = :category_id WHERE id = :id";
        $preparedQuery = $this->connection->prepare($query);

        $fields = ['name', 'price', 'description', 'category_id', 'id'];
        $this->clearProductFields($fields);

        $masksFields = ['name', 'price', 'description', 'category_id', 'id'];
        $this->bindProductParams($prepqredQuery, $masksFields);

        if ($preparedQuery->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProduct():bool {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $preparedQuery = $this->connection->prepare($query);

        $fields = ['id'];
        $this->clearProductFields($fields);

        $preparedQuery-> bindParam(1, $this->id);

        if ($preparedQuery->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function searchProduct($keywords) {
        $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN categories ON category_id = cat_id WHERE 
        name LIKE ? OR description LIKE ? OR price LIKE 300";

        $preparedQuery = $this->connection->prepare($query);

        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        for($i = 1; $i < 3; $i++) {
            $preparedQuery->bindParam($i, $keywords);
        }
        $preparedQuery->execute();
        return $preparedQuery;
    }
//Выводит товары в диапазоне от $max_on_page_num до $items_on_page
    public function readPagging($max_on_page_num, $items_on_page) {
        $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN categories ON category_id = cat_id LIMIT ?, ?";

        $preparedQuery = $this->connection->prepare($query);

        $preparedQuery->bindParam(1, $max_on_page_num, PDO::PARAM_INT);
        $preparedQuery->bindParam(2, $items_on_page, PDO::PARAM_INT);
        $preparedQuery->execute();

        return $preparedQuery;
    }
//Подсчитывает общее количество товаров
    public function paggingCount() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $preparedQuery = $this->connection->prepare($query);

        $preparedQuery->execute();
        $row = $preparedQuery->fetch(PDO::FETCH_ASSOC);

        return $row["total_rows"];
    }
}

function getProductEssence() {
    $database = new DATABASE();
    $db = $database->getConnection();
    return $product = new PRODUCT($db);
}

?>