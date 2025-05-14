<?php
class Database {
    private $host = "localhost";
    private $dbname = "digitalrdv";
    private $username = "root";
    private $password = "";
    protected $conn;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", 
                                  $this->username, $this->password);
            return $this->conn;
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}




