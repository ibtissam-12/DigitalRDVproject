<?php
session_start();

// Configuration de la base de données
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "digitalrdv";

// Gestion de la connexion
$error_message = "";
$user = null;

// Si l'utilisateur soumet le formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['mot_de_passe'])) {
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];

        // Recherche l'utilisateur par email
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            // Connexion réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirection selon le rôle
            if ($user['role'] === 'admin') {
                header("Location: accueil-copy.php");
            } else {
                header("Location: accueil.php");
            }
            exit;
        } else {
            $error_message = "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur de connexion à la base de données.";
    }
}

// Si l'utilisateur est connecté, récupère ses infos
if (isset($_SESSION['user_id'])) {
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $user_id = $_SESSION['user_id'];
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            session_destroy();
            header("Location: login.php");
            exit;
        }
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la récupération du profil.";
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
        background-color: #f8f9fa;
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
      
      /* Style pour le nouveau formulaire de connexion */
      .login-container {
        max-width: 500px;
        margin: 60px auto;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
      }
      .login-title {
        color: rgb(21, 194, 159);
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
      }
      .login-form .form-group {
        margin-bottom: 25px;
      }
      .login-form .input-group {
        position: relative;
      }
      .login-form .input-icon {
        position: absolute;
        left: 15px;
        top: 13px;
        color: #999;
        z-index: 10;
      }
      .login-form .form-control {
        height: 50px;
        padding-left: 45px;
        border-radius: 25px;
        font-size: 15px;
        border: 1px solid #ddd;
      }
      .login-form .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(21, 194, 159, 0.25);
        border-color: rgb(21, 194, 159);
      }
      .login-btn-submit {
        display: block;
        width: 100%;
        height: 50px;
        border-radius: 25px;
        background-color: rgb(21, 194, 159);
        border: none;
        color: white;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        margin-top: 10px;
      }
      .login-btn-submit:hover {
        background-color: rgb(17, 173, 140);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(21, 194, 159, 0.3);
      }
      .login-form .forgot-password {
        text-align: right;
        margin-top: 5px;
      }
      .login-form .forgot-password a {
        color: #666;
        font-size: 14px;
        text-decoration: none;
      }
      .login-form .forgot-password a:hover {
        color: rgb(21, 194, 159);
      }
      .login-separator {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 30px 0;
      }
      .login-separator::before,
      .login-separator::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #ddd;
      }
      .login-separator span {
        padding: 0 10px;
        color: #777;
        text-transform: uppercase;
        font-size: 14px;
      }
      .signup-link {
        display: block;
        text-align: center;
        padding: 10px 0;
        margin-top: 10px;
        border-radius: 25px;
        border: 1px solid rgb(21, 194, 159);
        color: rgb(21, 194, 159);
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
      }
      .signup-link:hover {
        background-color: rgba(21, 194, 159, 0.1);
        text-decoration: none;
        color: rgb(17, 173, 140);
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
      <?php if ($error_message): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Erreur!</strong> <?php echo $error_message; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if (isset($_SESSION['user_id']) && $user): ?>
        <div class="row justify-content-center">
          <div class="col-md-8 profile-card">
            <div class="profile-title">Mon Profil</div>
            <div class="profile-info">
              <div class="form-group">
                <label>Nom :</label>
                <p><?php echo htmlspecialchars($user['nom']); ?></p>
              </div>
              <div class="form-group">
                <label>Prénom :</label>
                <p><?php echo htmlspecialchars($user['prenom']); ?></p>
              </div>
              <div class="form-group">
                <label>Email :</label>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
              </div>
              <?php if (isset($user['tel'])): ?>
              <div class="form-group">
                <label>Téléphone :</label>
                <p><?php echo htmlspecialchars($user['tel']); ?></p>
              </div>
              <?php endif; ?>
              <?php if (isset($user['adresse'])): ?>
              <div class="form-group">
                <label>Adresse :</label>
                <p><?php echo htmlspecialchars($user['adresse']); ?></p>
              </div>
              <?php endif; ?>
              <a href="modifier-profil.php" class="btn btn1 mt-3">Modifier mes informations</a>
            </div>
          </div>
        </div>
      <?php else: ?>
        <!-- Nouveau Formulaire de connexion -->
        <div class="login-container">
          <div class="login-title">CONNEXION</div>
          <form method="post" action="login.php" class="login-form">
            <div class="form-group">
              <div class="input-group">
                <span class="input-icon"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre Email" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-icon"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez votre mot de passe" required>
              </div>
              <div class="forgot-password">
                <a href="passwordReset.php">Mot de passe oublié ?</a>
              </div>
            </div>
            <button type="submit" class="login-btn-submit">SE CONNECTER</button>
          </form>
          
          <div class="login-separator">
            <span>OU</span>
          </div>
          
          <a href="inscription.php" class="signup-link">PAS DE COMPTE ? S'INSCRIRE</a>
        </div>
      <?php endif; ?>
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