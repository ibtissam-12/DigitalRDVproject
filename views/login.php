<?php
session_start();

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=digitalrdv;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données']));
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email ou mot de passe manquant']);
    exit;
}

// Récupère l'utilisateur depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode(['success' => false, 'message' => 'Identifiants incorrects']);
    exit;
}

// Vérifie le mot de passe
if (!password_verify($password, $user['mot_de_passe'])) {
    echo json_encode(['success' => false, 'message' => 'Mot de passe incorrect']);
    exit;
}

// Stocke des informations en session
$_SESSION['email'] = $user['email'];
$_SESSION['role'] = $user['role'];

// Redirige selon le rôle
$redirect = match ($user['role']) {
    'medecin', 'admin' => '/projetWeb/views/doctor-dashboard.php',
    'patient' => '/projetWeb/views/patient-dashboard.php',
    default => '/projetWeb/login.html'
};

echo json_encode([
    'success' => true,
    'redirect' => $redirect
]);
?>