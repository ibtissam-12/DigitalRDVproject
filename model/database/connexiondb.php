
<?php
// Paramètres de connexion à la base de données
$host = "localhost";
$db_name = "digitalrdv";
$username = "root";
$password = "";

try {
    // Tentative de connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

    // Configuration de l'attribut pour afficher les erreurs
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si la connexion est réussie, afficher un message
    echo "Connexion réussie à la base de données $db_name !";

} catch (PDOException $exception) {
    // Si une erreur se produit, afficher l'erreur
    echo "Erreur de connexion : " . $exception->getMessage();
}
?>

