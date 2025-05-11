<?php
<<<<<<< HEAD
require_once 'connexiondb.php';
=======
require_once 'database/connexiondb.php';
>>>>>>> 0500448f5a313fc5e1648f553761c447e4e31a80

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

<<<<<<< HEAD
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

=======
    public function inscrire($nom, $prenom, $email, $mot_de_passe, $role) {
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (nom, prenom, email, mot_de_passe, role)
                VALUES (:nom, :prenom, :email, :mot_de_passe, :role)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => $mot_de_passe_hash,
            ':role' => $role
        ]);
    }

    public function connecter($email, $mot_de_passe) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user; // connexion réussie
        }
        return false; // échec
    }
}
?>
>>>>>>> 0500448f5a313fc5e1648f553761c447e4e31a80
