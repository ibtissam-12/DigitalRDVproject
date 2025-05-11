<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../model/User.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mot_de_passe = $_POST['mot_de_passe'];
    $confirmer = $_POST['confirmer'];
    $role = $_POST['role'];

    if ($mot_de_passe !== $confirmer) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    if (strlen($mot_de_passe) < 8) {
        echo "Le mot de passe doit contenir au moins 8 caractères.";
        exit;
    }

    // Hachage du mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    $user = new User();
    $success = $user->register($nom, $prenom, $email, $mot_de_passe_hash, $role);

    if ($success) {
        header("Location: ../views/accueil.html");
        exit;
    } else {
        echo "Échec de l'inscription. Veuillez réessayer.";
    }
}
?>


