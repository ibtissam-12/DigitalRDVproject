<?php
require_once 'connexiondb.php'; // adapte le chemin si nécessaire

$database = new Database();
$conn = $database->getConnection();

if ($conn) {
    echo "✅ Connexion réussie à la base de données.";
} else {
    echo "❌ Échec de la connexion à la base de données.";
}
?>



