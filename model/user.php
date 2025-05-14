<?php
require_once 'database/connexiondb.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function register($nom, $prenom, $email, $mot_de_passe) {
        $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, $hash]);
    }

    public function login($email, $mot_de_passe) {
        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }
}
?>





