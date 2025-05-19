<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // L'utilisateur n'est pas connecté, afficher un message d'erreur
    echo '
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accès refusé</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css ">
        <style>
            body {
                background-color: #f8f9fa;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                font-family: "Poppins", sans-serif;
            }
            .access-denied {
                text-align: center;
                padding: 30px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }
            .access-denied h1 {
                color: #dc3545;
                margin-bottom: 20px;
            }
            .access-denied p {
                font-size: 1.1rem;
                margin-bottom: 30px;
            }
            .access-denied a {
                text-decoration: none;
            }
        </style>
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes rendez-vous</title>
    <!-- fevicon -->
    <link rel="icon" href="images/logo.png" type="image/gif" />
    <link rel="stylesheet" href="style.css">
    <!-- Lien vers le fichier CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animation library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Lien vers le fichier JavaScript de Bootstrap (avec jQuery et Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
      body {
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
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
      .shadow-custom {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
      body {
        padding-top: 80px; /* Ajuste selon la hauteur de ta navbar */
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
    </style>

</head>
<body>
   
    <!-- NAVBAR  -->

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
              <a class="nav-link ml-4" href="rendezvous.php">Prendre rendez-vous</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ml-4" href="mes-rendez-vous.php">Mes rendez-vous</a>
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
    <!-- Fin de la navbar -->
    <div class="container py-5">
      <h2 class="text-center mb-4" style="color: rgb(21,194,159);" data-aos="fade-up">Mes Rendez-vous</h2>
  
      <div class="table-responsive" data-aos="zoom-in" data-aos-delay="200">
        <table class="table table-hover bg-white shadow-sm rounded">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Date</th>
              <th>Heure</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="table-body">
           
          </tbody>
        </table>
      </div>
  
      <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="300">
        <a href="rendezvous.php" class="btn btn-retour">Prendre un nouveau rendez-vous</a>
      </div>
    </div>

    <!-- SCRIPTS  -->
    <script>
      let rendezvous = [
        { nom: "Hayrana", date: "2025-05-04", heure: "14:00" },
        { nom: "Hayrana", date: "2025-05-12", heure: "09:30" }
      ];
  
      function afficherRendezvous() {
        const tbody = document.getElementById("table-body");
        tbody.innerHTML = "";
  
        if (rendezvous.length === 0) {
          tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">Aucun rendez-vous prévu.</td></tr>`;
          return;
        }
  
        rendezvous.forEach((rdv, index) => {
          tbody.innerHTML += `
            <tr data-aos="fade-up" data-aos-delay="${index * 100}">
              <td>${rdv.nom}</td>
              <td>${rdv.date}</td>
              <td>${rdv.heure}</td>
              <td><button class="btn btn-annuler" onclick="annuler(${index})">Annuler</button></td>
            </tr>
          `;
        });
      }
      function annuler(index) {
        if (confirm("Voulez-vous vraiment annuler ce rendez-vous ?")) {
          rendezvous.splice(index, 1);
          afficherRendezvous();
        }
      }
  
      afficherRendezvous();
    </script>
  
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    

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
              <img src="images/linkden.png" alt="linkden" width="40" class="m-2">
            </a>
          </div>

        </div>
      </div>

      <div class="text-center p-3 copyright">
        © 2025 DigitalRDV - Tous droits réservés
      </div>
    </footer>

    <!-- Animation Script - Updated for smaller navbar -->
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
      });
    </script>
</body>
</html>





