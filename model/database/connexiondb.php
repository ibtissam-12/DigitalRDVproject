<?php
class Database {
    private $host = "localhost";
    private $db_name = "digitalrdv";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Connexion PDO avec gestion des erreurs
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                  $this->username, 
                                  $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active le mode exception pour gérer les erreurs PDO
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage(); // Affiche l'erreur détaillée si une exception se produit
        }

        return $this->conn;
    }
}

?>
