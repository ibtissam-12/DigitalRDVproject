<?php
session_start();

$client_id = "679790544294-0h193q32m4urv5acdo9hm3bju94q4qdt.apps.googleusercontent.com";
$payload = json_decode(file_get_contents('php://input'))->credential;

try {
    $token = $payload;
    $url = 'https://oauth2.googleapis.com/tokeninfo?id_token= ' . $token;

    $userInfo = json_decode(file_get_contents($url));

    if ($userInfo->aud !== $client_id) {
        echo "Connexion Google invalide.";
        exit;
    }

    // Stocke l'email et vérifie si c'est un médecin
    $_SESSION['email'] = $userInfo->email;
    $_SESSION['role'] = ($userInfo->email === 'dr.john@clinic.com') ? 'doctor' : 'user';

    header("Location: doctor-dashboard.php");
    exit;
} catch (Exception $e) {
    echo "Erreur lors de la connexion Google.";
}
?>