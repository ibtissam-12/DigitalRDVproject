<?php
session_start();

// Email spécial du médecin
define('DOCTOR_EMAIL', 'dr.john@clinic.com');
define('DOCTOR_PASSWORD_HASH', password_hash('doctor123', PASSWORD_DEFAULT));

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email ou mot de passe manquant']);
    exit;
}

// Simule une base de données
$valid_users = [
    'patient@example.com' => password_hash('patient123', PASSWORD_DEFAULT),
];

$isDoctor = false;

if ($email === DOCTOR_EMAIL && password_verify($password, DOCTOR_PASSWORD_HASH)) {
    $isDoctor = true;
} elseif (isset($valid_users[$email]) && password_verify($password, $valid_users[$email])) {
    $isDoctor = false;
} else {
    echo json_encode(['success' => false, 'message' => 'Identifiants incorrects']);
    exit;
}

// Stocke des infos en session
$_SESSION['email'] = $email;
$_SESSION['role'] = $isDoctor ? 'doctor' : 'user';

echo json_encode([
    'success' => true,
    'redirect' => $isDoctor ? 'doctor-dashboard.php' : 'patient-dashboard.php'
]);
?>