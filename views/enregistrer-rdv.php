<?php
// filepath: c:\xampp\htdocs\DigitalRDVproject\views\enregistrer-rdv.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base de données
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=digitalrdv;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les données du formulaire
        $service = $_POST['service'] ?? '';
        $date = $_POST['date'] ?? '';
        $heure = $_POST['heure'] ?? '';
        $firstName = $_POST['firstName'] ?? '';
        $lastName = $_POST['lastName'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $notes = $_POST['notes'] ?? '';

        // Préparer la requête d'insertion
        $stmt = $pdo->prepare("INSERT INTO rendezvous (nom, prenom, email, telephone, service, date, heure, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$lastName, $firstName, $email, $phone, $service, $date, $heure, $notes]);

        // Rediriger vers la page de confirmation
        header('Location: confirmation-rendez-vous.html?success=1');
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement : " . $e->getMessage());
    }
} else {
    header('Location: rendezvous1.php');
    exit;
}