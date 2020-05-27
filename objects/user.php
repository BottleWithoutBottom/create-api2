<?php

class USER {
    private $connection;
    private $table_name = "users";

    public $user_id;
    public $user_name;
    public $user_phone;
    public $password;
    public $email;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function clearUserFields(array $fields = []):bool {
        foreach ($fields as $field) {

            $this->$field = htmlspecialchars(strip_tags($this->$field));
        }
        return true;
    }

    public function bindUserParams($preparedQuery, array $masks = []) {
        foreach ($masks as $mask) {
            $preparedQuery->bindParam('\':' . $mask . '\'', $this->$mask);
            var_dump($this->$mask);
        }

        return true;
    }

    public function addUser() {
        $query = "INSERT INTO " . $this->table_name . " SET user_name = :user_name, user_phone = :user_phone, email = :email, password = :password";
        var_dump($query);
        $preparedQuery = $this->connection->prepare($query);
        // $fields = ["user_name", "user_phone", "email", "password"];
        // $this->clearUserFields($fields);
        // $fieldsNoPass = ["user_name", "user_phone", "email"];
        // $this->bindUserParams($preparedQuery, $fieldsNoPass);
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_phone = htmlspecialchars(strip_tags($this->user_phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $preparedQuery->bindParam(':user_name', $this->user_name);
        $preparedQuery->bindParam(':user_phone', $this->user_phone);
        $preparedQuery->bindParam(':email', $this->email);

        $hashed_pass = password_hash($this->password, PASSWORD_BCRYPT);
        $preparedQuery->bindParam(':password', $hashed_pass);
        if ($preparedQuery->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkEmail() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";

        $preparedQuery = $this->connection->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $preparedQuery->bindParam(1, $this->email);

        $preparedQuery->execute();
        $rowsQuantity = $preparedQuery->rowCount();

        if ($rowsQuantity > 0) {
            $row = $preparedQuery->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['user_id'];
            $this->user_name = $row['user_name'];
            $this->password = $row['password'];

            return true;
        }
        return false;
    }
}

function getUserEssense() {
    $database = new DATABASE();
    $db = $database->getConnection();
    return new USER($db);
}