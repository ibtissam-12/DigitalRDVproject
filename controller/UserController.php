<?php
require_once '../model/User.php';
session_start();

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        // Récupérer les données du formulaire d'inscription
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $mot_de_passe = $_POST['password'] ?? ''; // correction ici : "password" comme dans le formulaire

        // On récupère le résultat (true ou message d'erreur)
        $result = $user->register($nom, $prenom, $email, $mot_de_passe);

        if ($result === true) {
            // Inscription réussie
            header('Location: ../views/registrationSucces.html');
            exit;
        } else {
            // Erreur, redirection vers la page d'inscription avec message d'erreur
            $error = urlencode($result);
            header("Location: ../views/inscription.php?error=$error"); // nom fichier corrigé ici
            exit;
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $email = $_POST['email'] ?? '';
        $mot_de_passe = $_POST['password'] ?? ''; // correction ici aussi

        $result = $user->login($email, $mot_de_passe);

        if ($result) {
            $_SESSION['user'] = $result;
            header('Location: ../views/accueil.php');
            exit;
        } else {
            header('Location: ../views/login.php?error=1');
            exit;
        }
    }
}


