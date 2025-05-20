<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=digitalrdv;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des rendez-vous de l'utilisateur connecté
    $stmt = $pdo->prepare("SELECT id, nom, date, heure FROM rendezvous WHERE utilisateur_id = :user_id ORDER BY date, heure");
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $rendezvous = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mes rendez-vous</title>
  <link rel="icon" href="images/logo.png" type="image/gif" />
  <link rel="stylesheet" href="style.css" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
      padding-top: 80px;
    }

    .navbar {
      background-color: rgba(255, 255, 255, 0.95) !important;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      padding: 8px 0;
      transition: all 0.3s ease;
    }

    .navbar-brand img {
      max-height: 40px;
      transition: transform 0.3s ease;
    }

    .navbar-brand img:hover {
      transform: scale(1.05);
    }

    .navbar .nav-link {
      color: #333 !important;
      font-weight: 500;
      margin: 0 8px;
      padding: 5px 3px;
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
      bottom: -2px;
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
      padding: 6px 16px !important;
      transition: all 0.3s ease;
      font-weight: 600;
      font-size: 0.95rem;
    }

    .login-btn:hover {
      background-color: rgb(16, 165, 136);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(21, 194, 159, 0.3);
    }

    .login-btn img {
      transition: transform 0.3s ease;
    }

    .login-btn:hover img {
      transform: rotate(15deg);
    }

    .btn-annuler {
      background-color: rgb(255, 87, 87);
      border: none;
      border-radius: 30px;
      color: white;
      padding: 6px 15px;
    }

    .btn-annuler:hover {
      background-color: rgb(220, 53, 69);
    }

    .table thead {
      background-color: rgb(21,194,159);
      color: white;
    }

    .btn-retour {
      border-radius: 50px;
      background-color: rgb(21,194,159);
      color: white;
      border: none;
      padding: 8px 20px;
    }

    .btn-retour:hover {
      background-color: rgb(17, 160, 130);
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
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a href="#" class="navbar-brand"><img src="images/logo.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link ml-4" href="accueil.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link ml-4" href="rendezvous.php">Prendre rendez-vous</a></li>
        <li class="nav-item"><a class="nav-link ml-4" href="mes-rendez-vous.php">Mes rendez-vous</a></li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link font-weight-bold login-btn" href="logout.php">Déconnexion <img src="images/icon1.png" alt="" width="20px"></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenu -->
<div class="container py-5">
  <h2 class="text-center mb-4" style="color: rgb(21,194,159);">Mes Rendez-vous</h2>

  <div class="table-responsive">
    <table class="table table-hover bg-white shadow-sm rounded">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Date</th>
          <th>Heure</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($rendezvous) > 0): ?>
          <?php foreach ($rendezvous as $rdv): ?>
            <tr>
              <td><?= htmlspecialchars($rdv['nom']) ?></td>
              <td><?= htmlspecialchars($rdv['date']) ?></td>
              <td><?= htmlspecialchars($rdv['heure']) ?></td>
              <td>
                <form method="post" action="annuler_rdv.php" onsubmit="return confirm('Annuler ce rendez-vous ?')">
                  <input type="hidden" name="id" value="<?= $rdv['id'] ?>">
                  <button type="submit" class="btn btn-annuler">Annuler</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="4" class="text-center text-muted">Aucun rendez-vous prévu.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="text-center mt-4">
    <a href="rendezvous.php" class="btn btn-retour">Prendre un nouveau rendez-vous</a>
  </div>
</div>

</body>
</html>






