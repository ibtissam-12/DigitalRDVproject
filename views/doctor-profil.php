<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || ($_SESSION['role'] !== 'medecin' && $_SESSION['role'] !== 'admin')) {
    header('Location: login.php');
    exit;
}

// Connexion à la base de données
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "digitalrdv";

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les infos du médecin
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header('Location: logout.php');
        exit;
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Médecin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f8fafc 0%, #e2eafc 100%);
            min-height: 100vh;
        }
        .main-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 32px rgba(0,0,0,0.07);
            padding: 30px 25px;
            margin-top: 60px;
            width: 800px;
        }
        .profile-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #4f8cff;
            letter-spacing: 1px;
            margin-bottom: 30px;
            text-align: center;
        }
        .profile-info label {
            font-weight: 600;
            color: #4f8cff;
        }
        .navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 8px 0;
        }
        .navbar-brand img {
            border-radius: 8px;
        }
        .login-btn {
            background: #4f8cff;
            color: #fff !important;
            border-radius: 20px;
            padding: 6px 18px !important;
            margin-right: 8px;
            transition: background 0.2s;
            font-weight: 500;
        }
        .login-btn:hover {
            background: #2563eb;
            color: #fff !important;
        }
        .logout-btn {
            background: #ff4f4f;
            color: #fff !important;
            border-radius: 20px;
            padding: 6px 18px !important;
            transition: background 0.2s;
            font-weight: 500;
        }
        .logout-btn:hover {
            background: #d90429;
            color: #fff !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a href="accueil-copy.php" class="navbar-brand"><img src="images/logo.png" alt="Logo" width="40"></a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link ml-4" href="doctor-rendez-vous.php">Tous les rendez-vous</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item mr-2">
                        <a class="nav-link font-weight-bold login-btn" href="doctor-profil.php">Profil <i class="fas fa-user-circle"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold logout-btn" href="logout.php">Se déconnecter <i class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
        <div class="main-card mt-0 mx-auto">
            <h2 class="profile-title">Mon Profil</h2>
            <div class="profile-info">
                <div class="mb-3">
                    <label>Nom :</label>
                    <span><?= htmlspecialchars($user['nom']) ?></span>
                </div>
                <div class="mb-3">
                    <label>Prénom :</label>
                    <span><?= htmlspecialchars($user['prenom']) ?></span>
                </div>
                <div class="mb-3">
                    <label>Email :</label>
                    <span><?= htmlspecialchars($user['email']) ?></span>
                </div>
                <div class="mb-3">
                    <label>Rôle :</label>
                    <span><?= htmlspecialchars($user['role']) ?></span>
                </div>
                <!-- Ajoute d'autres champs si besoin -->
            </div>
        </div>
    </div>
</body>
</html>