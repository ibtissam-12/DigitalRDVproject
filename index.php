<?php
session_start();

// Si l'utilisateur est connecté, redirige selon son rôle
if (isset($_SESSION['user'])) {
    if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin') {
        header('Location: views/accueil copy.php');
        exit;
    } else {
        header('Location: views/accueil.php');
        exit;
    }
} else {
    // Sinon, redirige vers la page de connexion
    header('Location: views/login.php');
    exit;
}
?>