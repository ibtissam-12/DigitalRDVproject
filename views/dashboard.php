<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
</head>
<body>
    <h1>Bienvenue, <?= htmlspecialchars($user['prenom']) ?> !</h1>
    <p>Vous êtes connecté en tant que <strong><?= htmlspecialchars($user['role']) ?></strong>.</p>
    <a href="../controller/logout.php">Se déconnecter</a>
</body>
</html>
