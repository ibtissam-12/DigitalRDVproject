<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'medecin')) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $rdvId = intval($_GET['id']);

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=digitalrdv;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Supprimer le rendez-vous
        $stmt = $pdo->prepare("DELETE FROM rendezvous WHERE id = :id");
        $stmt->execute(['id' => $rdvId]);

        // Redirection après suppression
        header("Location: doctor-rendez-vous.php?success=1");
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
} else {
    header("Location: doctor-rendez-vous.php?error=invalid");
    exit;
}