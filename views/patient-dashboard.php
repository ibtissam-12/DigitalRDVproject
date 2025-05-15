<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.html");
    exit;
}
?>
<h1>Bonjour <?= htmlspecialchars($_SESSION['email']) ?></h1>
<a href="logout.php" class="btn btn-danger">Déconnexion</a>