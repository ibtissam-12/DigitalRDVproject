<?php
require_once 'Database.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function register($nom, $prenom, $email, $mot_de_passe, $role) {
        try {
            $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role)
                    VALUES (:nom, :prenom, :email, :mot_de_passe, :role)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe); // Le mot de passe doit être haché !
            $stmt->bindParam(':role', $role);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Affiche une erreur si l'email existe déjà ou autre
            echo "Erreur d'inscription : " . $e->getMessage();
            return false;
        }
    }
}
?>

