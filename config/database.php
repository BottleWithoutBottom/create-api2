<?php

class DATABASE {
    private $host = "localhost";
    private $dbname = "api";
    private $username = "root";
    private $password = "";
    public $connection;

    public function getConnection() {
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        } catch(PDOexception $exception) {
            echo "connection DB error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}

?>