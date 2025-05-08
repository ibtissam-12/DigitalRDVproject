<?php
require_once '../model/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $confirmer = $_POST['confirmer'];
    $role = $_POST['role'];

    if ($mot_de_passe !== $confirmer) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    // Vérifie la force du mot de passe ici si nécessaire...

    $user = new User();
    if ($user->inscrire($nom, $prenom, $email, $mot_de_passe, $role)) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>
