<?php
require_once '../model/User.php';
session_start();

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'register') {
        $user->register($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mot_de_passe']);
        header('Location: ../views/registrationSucces.html');
        exit;
    }

    if ($_POST['action'] === 'login') {
        $result = $user->login($_POST['email'], $_POST['mot_de_passe']);
        if ($result) {
            $_SESSION['user'] = $result;
            header('Location: ../views/dashboard.php');
            exit;
        } else {
            header('Location: ../views/login.php?error=1');
            exit;
        }
    }
}
?>
