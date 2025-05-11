<?php
require_once 'database/connexiondb.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function inscrire($nom, $prenom, $email, $mot_de_passe, $role) {
        // Vérification si l'email existe déjà
        $checkEmail = $this->conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $checkEmail->execute([':email' => $email]);
        if ($checkEmail->rowCount() > 0) {
            echo "Cet email est déjà utilisé.";
            return false; // Retourner false si l'email existe déjà
        }

        // Hash du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insertion des données dans la base
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) 
                VALUES (:nom, :prenom, :email, :mot_de_passe, :role)";
        $stmt = $this->conn->prepare($sql);

        // Exécution de la requête d'insertion
        if ($stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => $mot_de_passe_hash,
            ':role' => $role
        ])) {
            return true; // Inscription réussie
        } else {
            echo "Erreur lors de l'insertion : " . implode(", ", $stmt->errorInfo());
            return false; // Retourner false en cas d'erreur
        }
    }
}

?>
