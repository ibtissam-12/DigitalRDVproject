<?php
class Database {
    private $host = "localhost";
    private $db_name = "digitalrdv";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // ✅ Message de succès :
                echo "<p style='color: green;'>Connexion réussie à la base de données !</p>";

            } catch (PDOException $e) {
                die("<p style='color: red;'>Erreur de connexion à la base de données : " . $e->getMessage() . "</p>");
            }
        }
        return $this->conn;
    }
}
?>



