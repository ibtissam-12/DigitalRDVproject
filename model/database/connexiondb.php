<<<<<<< HEAD

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

=======
<?php
class Database {
    private $host = "localhost";
    private $db_name = "digitalrdv";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Connexion PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                  $this->username, 
                                  $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
>>>>>>> 0500448f5a313fc5e1648f553761c447e4e31a80
