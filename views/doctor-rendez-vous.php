<?php
session_start();

// Vérification de l'accès (admin ou médecin)
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'medecin')) {
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

    // Récupérer tous les rendez-vous
    $stmt = $pdo->query("SELECT * FROM rendezvous ORDER BY date DESC, heure DESC");
    $rendezvous = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tous les rendez-vous</title>
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
        }
        .table thead th {
            background: #4f8cff;
            color: #fff;
            font-weight: 600;
            border: none;
        }
        .table tbody tr:hover {
            background: #f1f7ff;
            transition: background 0.2s;
        }
        .page-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #4f8cff;
            letter-spacing: 1px;
            margin-bottom: 30px;
            text-align: center;
        }
        .navbar {
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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
    <nav class="navbar navbar-expand-lg bg-light navbar-light">
        <div class="container">
            <a href="#" class="navbar-brand"><img src="images/logo.png" alt="" width="40"></a>
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

    <div class="container">
        <div class="main-card mt-5">
            <h2 class="page-title">Tous les rendez-vous</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Statut</th>
                            <th>Action</th> <!-- Ajout colonne action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($rendezvous) > 0): ?>
                            <?php foreach ($rendezvous as $rdv): ?>
                                <tr>
                                    <td><?= htmlspecialchars($rdv['id']) ?></td>
                                    <td><?= htmlspecialchars($rdv['utilisateur_id']) ?></td>
                                    <td><?= htmlspecialchars($rdv['nom']) ?></td>
                                    <td><?= htmlspecialchars($rdv['email']) ?></td>
                                    <td><?= htmlspecialchars($rdv['date']) ?></td>
                                    <td><?= htmlspecialchars($rdv['heure']) ?></td>
                                    <td>
                                        <?php
                                            $badge = 'secondary';
                                            if ($rdv['statut'] === 'prévu') $badge = 'info';
                                            elseif ($rdv['statut'] === 'annulé') $badge = 'danger';
                                            elseif ($rdv['statut'] === 'terminé') $badge = 'success';
                                        ?>
                                        <span class="badge badge-<?= $badge ?>">
                                            <?= htmlspecialchars($rdv['statut']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($rdv['statut'] !== 'annulé' && $rdv['statut'] !== 'terminé'): ?>
                                            <a href="doctor_annuler_rdv.php?id=<?= urlencode($rdv['id']) ?>"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Voulez-vous vraiment annuler ce rendez-vous ?');">
                                                Annuler
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Aucun rendez-vous trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>