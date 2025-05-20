<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Vérifier que l'ID du rendez-vous est présent
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $rdvId = intval($_POST['id']);
    $userId = $_SESSION['user_id'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=digitalrdv;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si le rendez-vous appartient bien à l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM rendezvous WHERE id = :id AND utilisateur_id = :user_id");
        $stmt->execute([
            'id' => $rdvId,
            'user_id' => $userId
        ]);

        if ($stmt->rowCount() > 0) {
            // Supprimer le rendez-vous
            $deleteStmt = $pdo->prepare("DELETE FROM rendezvous WHERE id = :id");
            $deleteStmt->execute(['id' => $rdvId]);

            // Rediriger avec un message de succès (facultatif)
            header("Location: mes-rendez-vous.php?success=1");
            exit;
        } else {
            // Accès non autorisé ou ID invalide
            header("Location: mes-rendez-vous.php?error=unauthorized");
            exit;
        }

    } catch (PDOException $e) {
        die("Erreur lors de l'annulation du rendez-vous : " . $e->getMessage());
    }
} else {
    // Requête invalide
    header("Location: mes_rendezvous.php?error=invalid");
    exit;
}