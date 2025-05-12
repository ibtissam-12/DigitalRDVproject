<?php
session_start();
require_once '../model/user.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    if (!empty($email) && !empty($password)) {
        $userModel = new User();
        $user = $userModel->login($email, $password);

        if ($user) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["role"] = $user["role"];
            header("Location: ../views/accueil.php");
            exit();
        } else {
            $_SESSION["error"] = "Email ou mot de passe incorrect.";
        }
    } else {
        $_SESSION["error"] = "Veuillez remplir tous les champs.";
    }

    header("Location: ../views/login.php");
    exit();
}
?>

