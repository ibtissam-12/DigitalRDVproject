<?php
require_once(__DIR__ . '/../database/connexiondb.php');

class User {
    private $conn;

    public function __construct() {
        // Connexion à la base de données via méthode statique Database::connect()
        $this->conn = Database::connect();
    }

    /**
     * Enregistre un nouvel utilisateur si l'email n'existe pas déjà.
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $mot_de_passe
     * @return bool|string Retourne true si succès, message d'erreur sinon
     */
    public function register($nom, $prenom, $email, $mot_de_passe,$confirmer) {
        // Vérifier si l'email existe déjà
        $checkSql = "SELECT COUNT(*) FROM utilisateurs WHERE email = ?";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->execute([$email]);
        $count = $checkStmt->fetchColumn();
        if ($mot_de_passe !== $confirmer) {
        return "Les mots de passe ne correspondent pas !";
    }
        if ($count > 0) {
            return "Email déjà utilisé !";
        }

        // Hash du mot de passe
        $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insertion dans la base de données
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt->execute([$nom, $prenom, $email, $hash])) {
            return true;
        } else {
            return "Erreur lors de l'enregistrement.";
        }
    }

    /**
     * Vérifie les informations de connexion
     * @param string $email
     * @param string $mot_de_passe
     * @return array|bool Retourne les données utilisateur si ok, false sinon
     */
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





