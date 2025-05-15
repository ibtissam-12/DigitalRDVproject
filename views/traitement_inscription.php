<?php
session_start();

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;dbname=digitalrdv;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';
        $confirmer = $_POST['confirmer'] ?? '';
        $role = $_POST['role'] ?? 'patient';

        // Vérifier que tous les champs sont remplis
        if (empty($nom) || empty($prenom) || empty($email) || empty($mot_de_passe) || empty($confirmer)) {
            $_SESSION['error'] = "Veuillez remplir tous les champs.";
            header("Location: inscription.php");
            exit;
        }

        // Vérifier que les mots de passe correspondent
        if ($mot_de_passe !== $confirmer) {
            $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
            header("Location: inscription.php");
            exit;
        }

        // Vérifier si l'email existe déjà
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = "Cet email est déjà utilisé.";
            header("Location: inscription.php");
            exit;
        }

        // Hacher le mot de passe
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute([$nom, $prenom, $email, $hashedPassword, $role]);

        if ($result) {
            // Succès
            $_SESSION['success'] = "Inscription réussie !";
            header("Location: login.html");
            exit;
        } else {
            // Échec sans exception
            $_SESSION['error'] = "Échec de l'inscription pour une raison inconnue.";
            header("Location: inscription.php");
            exit;
        }
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Erreur : " . $e->getMessage();
    header("Location: inscription.php");
    exit;
}
?>