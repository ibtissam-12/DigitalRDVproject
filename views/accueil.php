<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
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

      /* Styles pour les boutons Profil et Se déconnecter */
      .login-btn, .logout-btn {
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

      .logout-btn {
        background-color: #f44336;
      }

      .logout-btn:hover {
        background-color: #d32f2f;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
      }

      /* Style responsive pour les boutons */
      @media (max-width: 768px) {
        .login-btn, .logout-btn {
          margin-bottom: 8px;
          margin-left: 0;
        }
      }

      /* Updated Header and Welcome Image */
      header {
        position: relative;
        overflow: hidden;
        height: 70vh;
        margin-top: 60px; /* Reduced from 80px to match the smaller navbar */
      }

      header img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.85);
        transition: transform 5s ease;
      }

      header:hover img {
        transform: scale(1.05);
      }

      .header-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 2;
      }

      .textimg {
        color: white;
        font-size: 45px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        font-weight: 300;
        margin-bottom: 20px;
      }

      .nomproj {
        font-size: 70px;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        color: rgb(236, 236, 236);
        font-weight: 700;
        letter-spacing: 2px;
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

      .nomproj {
        animation: glow 2s infinite;
      }

      /* Services Section */
      .text {
        font-size: 40px;
        margin: 50px 0 30px;
        color: #333;
        text-align: center;
        position: relative;
        font-weight: 600;
      }

      .text::after {
        content: '';
        position: absolute;
        width: 80px;
        height: 4px;
        background-color: rgb(21, 194, 159);
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
      }

      .aboutimg {
        width: 350px;
        height: 350px;
        margin: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        object-fit: cover;
      }

      .aboutimg:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      }

      .service-box {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        background-color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
        padding: 30px 20px;
      }

      .service-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      }

      .service-box h3 {
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 15px;
      }

      .service-box h3::after {
        content: '';
        position: absolute;
        width: 50px;
        height: 3px;
        background-color: rgb(21, 194, 159);
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
      }

      .service-box p {
        color: #666;
        margin-bottom: 25px;
        line-height: 1.7;
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
              <a class="nav-link font-weight-bold login-btn" href="profile.html">Profil <i class="fas fa-user-circle"></i></a>
            </li>
            <li class="nav-item">
             <a class="nav-link font-weight-bold logout-btn" href="logout.php">Se déconnecter <i class="fas fa-sign-out-alt"></i></a>
            </li>
          </ul>
    
        </div>
      </div>
    </nav>
       
    <!-- Header with improved welcome image -->
    <header>
      <img src="images/Doctors-pana.png" alt="Medical team with heart icon" class="animate_animated animatefadeIn animate_slower">
      <div class="header-content">
        <p class="textimg text-center animate_animated animatefadeInDown animate_delay-1s">Bienvenue dans</p>
        <div class="nomproj text-center animate_animated animatefadeInUp animate_delay-1s">DigitalRDV</div>
      </div>
    </header>

    <!-- Services section with the other three images -->
    <div class="container">
      <p class="text fade-in">Nos services</p>
      <div class="row justify-content-center">
        <div class="col-md-4 text-center fade-in">
          <img class="aboutimg" src="images/Doctors-rafiki.png" alt="Medical professionals">
        </div>
        <div class="col-md-4 text-center fade-in">
          <img class="aboutimg" src="images/Online Doctor-amico.png" alt="Online medical chat">
        </div>
        <div class="col-md-4 text-center fade-in">
          <img class="aboutimg" src="images/Service 24_7-amico.png" alt="24/7 medical service">
        </div>
      </div>
    </div>

    <!-- Services description with hover effects -->
    <section class="container my-5">
      <div class="row text-center">
         
          <div class="col-md-4 mb-4 fade-in">
            <div class="service-box">
              <div class="service-icon mb-3">
                <i class="fas fa-calendar-check fa-3x" style="color: rgb(21, 194, 159);"></i>
              </div>
              <h3>Prendre rendez-vous</h3>
              <p>Réservez facilement vos consultations médicales en ligne en quelques clics. Choisissez le médecin, la spécialité et l'horaire qui vous conviennent le mieux, sans file d'attente ni déplacement inutile.</p>
              <a href="rendezvous.html"><button class="btn1">Prendre RDV</button></a>
            </div>
          </div>
        <div class="col-md-4 mb-4 fade-in">
          <div class="service-box">
            <div class="service-icon mb-3">
              <i class="fas fa-comments fa-3x" style="color: rgb(21, 194, 159);"></i>
            </div>
          
            <h3>Mes rendez-vous</h3>
<p>Consultez et gérez facilement vos rendez-vous médicaux. Accédez à l’historique, modifiez ou annulez vos rendez-vous, le tout en ligne et en toute sécurité.</p>

            <a href="mes-rendez-vous.php"><button class="btn1">Mes rendez-vous</button></a>
          </div>
        </div>
        <div class="col-md-4 mb-4 fade-in">
          <div class="service-box">
            <div class="service-icon mb-3">
              <i class="fas fa-clock fa-3x" style="color: rgb(21, 194, 159);"></i>
            </div>
            <h3>Services disponibles 24/7</h3>
            <p>Parce que votre santé n'attend pas, notre service est accessible 24 heures sur 24 et 7 jours sur 7. Prenez rendez-vous à tout moment, même les week-ends et jours fériés.</p>
            <a href="rendezvous.html"><button class="btn1">Prendre RDV</button></a>
          </div>
        </div>
      </div>
    </section>

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