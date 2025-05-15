<?php
require_once '../model/User.php';
session_start();

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'register') {
        // On récupère le résultat (true ou message d'erreur)
        $result = $user->register($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mot_de_passe']);

        if ($result === true) {
            // Inscription réussie
            header('Location: ../views/registrationSucces.html');
            exit;
        } else {
            // Erreur (ex: email déjà utilisé), on redirige vers la page d'inscription en passant le message en GET
            $error = urlencode($result);
            header("Location: ../views/login.php?error=$error");
            exit;
        }
    }

    if ($_POST['action'] === 'login') {
        $result = $user->login($_POST['email'], $_POST['mot_de_passe']);
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
?>

