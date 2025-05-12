<?php
session_start();
require_once '../model/user.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    if (!empty($name) && !empty($email) && !empty($password)) {
        $user = new User();
        if ($user->register($name, $email, $password)) {
            $_SESSION["success"] = "Inscription réussie !";
            header("Location: ../views/registrationSucces.html");
            exit();
        } else {
            $_SESSION["error"] = "Erreur : cet e-mail est déjà utilisé.";
        }
    } else {
        $_SESSION["error"] = "Tous les champs sont obligatoires.";
    }

    header("Location: ../views/inscription.php");
    exit();
}
?>




