<?php
session_start();
// Configuration de la base de données
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "digitalrdv";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

// Récupérer les informations de l'utilisateur
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Si l'utilisateur n'existe pas dans la base de données
        session_destroy();
        header("Location: login.php");
        exit;
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

// Gestion de la mise à jour des informations de l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $adresse = $_POST['adresse'];

        // Mettre à jour les informations de l'utilisateur dans la base de données
        $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ?, tel = ?, adresse = ? WHERE id = ?");
        $stmt->execute([$nom, $email, $tel, $adresse, $user_id]);

        // Rediriger vers la page de profil après la mise à jour
        header("Location: profil.php");
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour des informations: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mes informations - DigitalRDV</title>
    <!-- Include Bootstrap and other styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap @5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
      }
      body {
        background-color: #f8f9fa;
      }
      /* Navbar Styling - Compact Version */
      .navbar {
        background-color: rgba(255, 255, 255, 0.95) !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 8px 0; /* Reduced from 15px to 8px */
        transition: all 0.3s ease;
      }

      .navbar-brand img {
        height: auto; /* Add this to maintain aspect ratio */
        max-height: 40px; /* Control the logo size */
        transition: transform 0.3s ease;
      }

      .navbar-brand img:hover {
        transform: scale(1.05); /* Reduced scale effect */
      }

      .navbar .nav-link {
        color: #333 !important;
        font-weight: 500;
        margin: 0 8px; /* Reduced from 10px to 8px */
        padding: 5px 3px; /* Add custom padding for better control */
        position: relative;
        transition: color 0.3s ease;
      }

      .navbar .nav-link:hover {
        color: rgb(21, 194, 159) !important;
      }

      .navbar .nav-link::after {
        content: '';
        position: absolute;
        width: 0%;
        height: 2px;
        background-color: rgb(21, 194, 159);
        bottom: -2px; /* Changed from -5px to -2px */
        left: 0;
        transition: width 0.3s ease;
      }

      .navbar .nav-link:hover::after {
        width: 100%;
      }

      .login-btn {
        background-color: rgb(21, 194, 159);
        color: white !important;
        border-radius: 30px;
        padding: 6px 16px !important; /* Reduced padding */
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 0.95rem; /* Slightly smaller font */
      }

      .login-btn:hover {
        background-color: rgb(16, 165, 136);
        transform: translateY(-2px); /* Reduced from -3px to -2px */
        box-shadow: 0 4px 12px rgba(21, 194, 159, 0.3);
      }

      .login-btn img {
        transition: transform 0.3s ease;
      }

      .login-btn:hover img {
        transform: rotate(15deg);
      }
      .navbar:hover {
        color: rgb(9, 163, 112);
      }
    
    
    
      body {
        padding-top: 80px; /* Ajuste selon la hauteur de ta navbar */
      }
    
    .shadow-custom {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .profile-form {
      background: white;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 50px;
    }

      @keyframes glow {
        0% {
          text-shadow: 0 0 10px rgba(21, 194, 159, 0.5);
        }
        50% {
          text-shadow: 0 0 20px rgba(21, 194, 159, 0.8), 0 0 30px rgba(21, 194, 159, 0.5);
        }
        100% {
          text-shadow: 0 0 10px rgba(21, 194, 159, 0.5);
        }
      }
      .btn1 {
        border-radius: 30px;
        background-color: rgb(21, 194, 159);
        color: white;
        border: none;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-block;
      }

      .btn1:hover {
        background-color: rgb(16, 165, 136);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(21, 194, 159, 0.3);
      }

      /* Footer Styling */
      footer {
        margin-top: 50px;
      }

      footer h5 {
        color: rgb(21, 194, 159);
        font-weight: 600;
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 20px;
      }

      footer h5::after {
        content: '';
        position: absolute;
        width: 50px;
        height: 3px;
        background-color: rgb(21, 194, 159);
        bottom: 0;
        left: 0;
      }

      footer p {
        color: #666;
        line-height: 1.7;
      }

      footer a img {
        transition: all 0.3s ease;
      }

      footer a:hover img {
        transform: translateY(-5px);
      }

      .copyright {
        background-color: rgb(21, 194, 159);
        color: white !important;
        padding: 15px 0;
      }

      /* Animation classes */
      .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
      }

      .fade-in.active {
        opacity: 1;
        transform: translateY(0);
      }

      /* Media Queries for Responsiveness */
      @media (max-width: 992px) {
        .textimg {
          font-size: 35px;
        }
        .nomproj {
          font-size: 50px;
        }
        .aboutimg {
          width: 280px;
          height: 280px;
          margin: 15px;
        }
      }

      @media (max-width: 768px) {
        .textimg {
          font-size: 30px;
        }
        .nomproj {
          font-size: 40px;
        }
        .aboutimg {
          width: 250px;
          height: 250px;
          margin: 10px;
        }
        header {
          height: 50vh;
        }
      }

      @media (max-width: 576px) {
        .textimg {
          font-size: 24px;
          width: 90%;
          text-align: center;
        }
        .nomproj {
          font-size: 32px;
          width: 90%;
          text-align: center;
        }
        .aboutimg {
          width: 80%;
          height: auto;
          margin: 10px auto;
          display: block;
        }
      }
      .profile-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 50px;
      }
  
      .profile-title {
        color: rgb(21, 194, 159);
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 20px;
      }
  
      .profile-info label {
        font-weight: bold;
      }
  
      .btn1 {
        border-radius: 60px;
        background-color: rgb(21, 194, 159);
        border-color: transparent;
        color: white;
        padding: 10px 30px;
      }
  
      .btn1:hover {
        background-color: rgb(17, 173, 140);
      }
      .shadow-custom {
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-title {
          color: rgb(21, 194, 159);
          font-size: 30px;
          font-weight: bold;
          margin-bottom: 25px;
          text-align: center;
        }
    
        .btn1 {
          border-radius: 60px;
          background-color: rgb(21, 194, 159);
          border: none;
          color: white;
          padding: 10px 30px;
        }
    
        .btn1:hover {
          background-color: rgb(17, 173, 140);
        }
    
        label {
          font-weight: bold;
        }
    

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DigitalRDV</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="accueil.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rendezvous.php">Prendre rendez-vous</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mes-rendez-vous.php">Mes rendez-vous</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Profil <i class="bi bi-person-circle"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Se déconnecter <i class="bi bi-box-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-success text-center">Modifier mes informations</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo htmlspecialchars($user['tel']); ?>">
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo htmlspecialchars($user['adresse']); ?>">
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="profil.php" class="btn btn-secondary ms-2">Annuler</a>
        </form>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap @5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>