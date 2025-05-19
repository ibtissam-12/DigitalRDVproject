<?php
session_start();
require_once '../model/rdv.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $date = $_POST['date'] ?? '';
    $heure = $_POST['heure'] ?? '';
    $utilisateur_id = $_SESSION['user']['id'];

    $rdv = new Rendezvous();
    $result = $rdv->ajouterRendezvous($utilisateur_id, $date, $heure);

    if ($result === true) {
        header('Location: ../views/rendezvous.php?success=1');
        exit;
    } else {
        header('Location: ../views/rendezvous.php?error=' . urlencode($result));
        exit;
    }
}