<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // ... (garde ton code d'accès refusé ici)
    echo '
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accès refusé</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css ">
        <style>body{background-color:#f8f9fa;display:flex;justify-content:center;align-items:center;height:100vh;font-family:"Poppins",sans-serif;}.access-denied{text-align:center;padding:30px;background:white;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.1);}.access-denied h1{color:#dc3545;margin-bottom:20px;}.access-denied p{font-size:1.1rem;margin-bottom:30px;}.access-denied a{text-decoration:none;}</style>
    </head>
    <body>
        <div class="access-denied">
            <h1>Accès refusé</h1>
            <p>Vous devez être connecté pour accéder à cette page.</p>
            <a href="login.php" class="btn btn-primary">Se connecter</a>
        </div>
    </body>
    </html>
    ';
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=digitalrdv;charset=utf8', 'root', '');

// Récupérer les infos actuelles de l'utilisateur
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$message = "";

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);

    $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':id' => $user_id
        ]);
        $message = "Profil mis à jour avec succès.";
        // Met à jour les infos affichées
        $user['nom'] = $nom;
        $user['prenom'] = $prenom;
        $user['email'] = $email;
    } catch (PDOException $e) {
        $message = "Erreur lors de la mise à jour : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion / Profil - DigitalRDV</title>
    <link rel="icon" href="images/logo.png" type="image/gif" />
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
        height: auto;
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
      .logout-btn {
        color: #333 !important;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 0.95rem;
      }
      .logout-btn:hover {
        color: rgb(21, 194, 159) !important;
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
        color: #555;
      }
      .profile-info p {
        margin-bottom: 15px;
        font-size: 16px;
      }
      .btn1 {
        border-radius: 60px;
        background-color: rgb(21, 194, 159);
        border-color: transparent;
        color: white;
        padding: 10px 30px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-block;
      }
      .btn1:hover {
        background-color: rgb(17, 173, 140);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(21, 194, 159, 0.3);
      }
      .alert {
        border-radius: 15px;
        padding: 15px 20px;
      }
      footer {
        margin-top: 80px;
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
      .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
      }
      .fade-in.active {
        opacity: 1;
        transform: translateY(0);
      }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top">
      <div class="container">
        <a href="accueil.php" class="navbar-brand"><img src="images/logo.png" alt="DigitalRDV Logo" width="40"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link ml-4" href="accueil.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ml-4" href="rendezvous.php">Prendre rendez-vous</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ml-4" href="mes-rendez-vous.php">Mes rendez-vous</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item mr-2">
              <a class="nav-link font-weight-bold login-btn" href="login.php">Profil <i class="fas fa-user-circle"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-weight-bold logout-btn" href="logout.php">Se déconnecter <i class="fas fa-sign-out-alt"></i></a>
            </li>
            <?php else: ?>
            <li class="nav-item mr-2">
              <a class="nav-link font-weight-bold login-btn" href="login.php">Connexion</a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <?php if ($message): ?>
        <div class="alert alert-info mt-4"><?php echo $message; ?></div>
      <?php endif; ?>
      <div class="row justify-content-center">
        <div class="col-md-8 profile-form">
          <h3 class="text-center mb-4" style="color: rgb(21, 194, 159); font-weight: bold; letter-spacing: 1px;">
            <i class="fas fa-user-edit mr-2"></i>Modifier mes informations
          </h3>
          <form action="" method="post">
            <div class="form-group">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom</label>
              <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required>
            </div>
            <div class="form-group">
              <label for="email">Adresse email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn1 mt-3">Enregistrer</button>
            <a href="profile.php" class="btn btn-secondary mt-3 ml-2">Annuler</a>
          </form>
        </div>
      </div>
    </div>

    <footer class="bg-light text-center text-lg-start">
      <div class="container p-4">
        <div class="row">
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0 fade-in">
            <h5>Contactez-nous</h5>
            <p>
              Vous avez des questions ? N'hésitez pas à nous contacter pour toute assistance ou information supplémentaire.
            </p>
            <div class="mt-4">
              <i class="fas fa-phone-alt mr-2" style="color: rgb(21, 194, 159);"></i> +33 1 23 45 67 89<br>
              <i class="fas fa-envelope mr-2 mt-2" style="color: rgb(21, 194, 159);"></i> contact@digitalrdv.com
            </div>
          </div>
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0 fade-in">
            <h5>Suivez-nous</h5>
            <p>Restez connectés avec nous sur les réseaux sociaux pour les dernières nouvelles et mises à jour.</p>
            <a href="#" class="mr-3">
              <img src="images/facebook.png" alt="Facebook" width="40" class="m-2">
            </a>
            <a href="#" class="mr-3">
              <img src="images/instagram.png" alt="Instagram" width="40" class="m-2">
            </a>
            <a href="#" class="mr-3">
              <img src="images/linkden.png" alt="LinkedIn" width="40" class="m-2">
            </a>
          </div>
        </div>
      </div>
      <div class="text-center p-3 copyright">
        © 2025 DigitalRDV - Tous droits réservés
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
          navbar.style.padding = '5px 0';
          navbar.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
        } else {
          navbar.style.padding = '8px 0';
          navbar.style.boxShadow = '0 2px 8px rgba(0,0,0,0.08)';
        }
      });
      document.addEventListener('DOMContentLoaded', function() {
        const fadeElements = document.querySelectorAll('.fade-in');
        const fadeInOnScroll = function() {
          for (let i = 0; i < fadeElements.length; i++) {
            const elem = fadeElements[i];
            const distInView = elem.getBoundingClientRect().top - window.innerHeight + 100;
            if (distInView < 0) {
              elem.classList.add('active');
            }
          }
        };
        window.addEventListener('scroll', fadeInOnScroll);
        fadeInOnScroll();
        setTimeout(function() {
          $('.alert').alert('close');
        }, 5000);
      });
    </script>
</body>
</html>
