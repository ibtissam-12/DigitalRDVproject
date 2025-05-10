<?php
require_once '../model/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $confirmer = $_POST['confirmer'];
    $role = $_POST['role'];

    // Vérification de la correspondance des mots de passe
    if ($mot_de_passe !== $confirmer) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    // Instanciation de l'objet User
    $user = new User();

    // Appel de la méthode d'inscription
    if ($user->inscrire($nom, $prenom, $email, $mot_de_passe, $role)) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>





