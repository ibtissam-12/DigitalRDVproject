

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - DigitalRDV</title>
    <!-- fevicon -->
    <link rel="icon" href="images/logo.png" type="image/gif" />
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animation library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
      body {
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
        padding-top: 80px; /* Ajuste selon la hauteur de ta navbar */
      }

      /* Navbar Styling */
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

      /* Profile Card Styling */
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

      /* Alert Styling */
      .alert {
        border-radius: 15px;
        padding: 15px 20px;
      }

      /* Footer Styling */
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
    </style>
</head>
<body>
   <!-- Navbar avec boutons Profil et Se déconnecter -->
    <nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top">
      <div class="container">
        <a href="#" class="navbar-brand"><img src="images/logo.png" alt="" width="40"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarNav">
          
          <!-- Liens à gauche -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link ml-4" href="accueil.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ml-4" href="rendezvous.html">Prendre rendez-vous</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ml-4" href="mes-rendez-vous.html">Mes rendez-vous</a>
            </li>
          </ul>
    
          <!-- Liens à droite -->
          <ul class="navbar-nav">
            <li class="nav-item mr-2">
              <a class="nav-link font-weight-bold login-btn" href="profile.php">Profil <i class="fas fa-user-circle"></i></a>
            </li>
            <li class="nav-item">
             <a class="nav-link font-weight-bold logout-btn" href="logout.php">Se déconnecter <i class="fas fa-sign-out-alt"></i></a>
            </li>
          </ul>
    
        </div>
      </div>
    </nav>
    
    <!-- Page Content -->  
    <div class="container">
      <?php if (isset($_GET['updated']) && $_GET['updated'] == 'success'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Succès!</strong> Votre profil a été mis à jour avec succès.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>
      
      <?php if (isset($error_message)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Erreur!</strong> <?php echo $error_message; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>
      
      <div class="row justify-content-center">
        <div class="col-md-8 profile-card">
          <div class="profile-title">Mon Profil</div>
          <div class="profile-info">
            <div class="form-group">
              <label>Nom complet :</label>
              <p><?php echo isset($user) ? htmlspecialchars($user['nom_complet']) : ''; ?></p>
            </div>
            <div class="form-group">
              <label>Email :</label>
              <p><?php echo isset($user) ? htmlspecialchars($user['email']) : ''; ?></p>
            </div>
            <div class="form-group">
              <label>Téléphone :</label>
              <p><?php echo isset($user) ? htmlspecialchars($user['telephone']) : ''; ?></p>
            </div>
            <div class="form-group">
              <label>Adresse :</label>
              <p><?php echo isset($user) ? htmlspecialchars($user['adresse']) : ''; ?></p>
            </div>
            <a href="modifier-profil.php" class="btn btn1 mt-3">Modifier mes informations</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Enhanced Footer -->
    <footer class="bg-light text-center text-lg-start">
      <div class="container p-4">
        <div class="row">
          
          <!-- Contactez-nous -->
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

          <!-- Réseaux sociaux -->
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

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Animation Script -->
    <script>
      // Navbar scroll effect
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
      
      // Fade-in animation on scroll
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
        // Initialize on page load
        fadeInOnScroll();
        
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
          $('.alert').alert('close');
        }, 5000);
      });
    </script>
</body>
</html>