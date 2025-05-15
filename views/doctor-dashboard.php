<?php
// Vérifie si l'utilisateur est connecté et a le rôle "doctor"
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalRDV - Tableau de bord Médecin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #e8f5e9;
            --accent-color: #2E7D32;
            --light-gray: #f8f9fa;
        }
        
        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }
        
        .nav-link {
            color: #333;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
        }
        
        .btn-connect {
            background-color: var(--primary-color);
            color: white;
            border-radius: 20px;
            padding: 0.5rem 1.5rem;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-connect:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
        }
        
        .welcome-section {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .welcome-section h1 {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .welcome-text {
            position: relative;
            z-index: 2;
        }
        
        .welcome-bg {
            position: absolute;
            right: -50px;
            top: -20px;
            max-width: 200px;
            opacity: 0.1;
            z-index: 1;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            height: 100%;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 1rem;
            border: none;
        }
        
        .card-title {
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-title i {
            font-size: 1.5rem;
        }
        
        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 0.8rem 1rem;
            transition: background-color 0.2s ease;
        }
        
        .list-group-item:hover {
            background-color: var(--secondary-color);
        }
        
        .list-group-item a {
            color: #333;
            text-decoration: none;
            display: block;
            transition: color 0.2s ease;
        }
        
        .list-group-item a:hover {
            color: var(--primary-color);
        }
        
        .list-group-item i {
            margin-right: 8px;
            color: var(--primary-color);
        }
        
        .badge-appointment {
            background-color: var(--primary-color);
            color: white;
            font-weight: normal;
        }
        
        .quick-stats {
            background-color: var(--secondary-color);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .quick-stats i {
            font-size: 2rem;
            color: var(--primary-color);
        }
        
        .quick-stats-info h4 {
            font-size: 1.3rem;
            margin: 0;
        }
        
        .quick-stats-info p {
            margin: 0;
            color: #666;
        }
        
        footer {
            background-color: white;
            padding: 1rem 0;
            margin-top: 3rem;
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <i class="bi bi-calendar-plus"></i>
                DigitalRDV
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="doctor-dashboard.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mes rendez-vous</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Disponibilités</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-connect">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="row">
                <div class="col-md-8 welcome-text">
                    <h1>Bonjour, Dr. <?= htmlspecialchars($_SESSION['email']) ?></h1>
                    <p>Bienvenue sur votre tableau de bord DigitalRDV. Voici un aperçu de votre journée.</p>
                </div>
            </div>
            <img src="https://via.placeholder.com/150/4CAF50/FFFFFF?text=+" class="welcome-bg" alt="Décoration">
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="quick-stats">
                    <i class="bi bi-calendar-check"></i>
                    <div class="quick-stats-info">
                        <h4>3</h4>
                        <p>Rendez-vous aujourd'hui</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="quick-stats">
                    <i class="bi bi-people"></i>
                    <div class="quick-stats-info">
                        <h4>24</h4>
                        <p>Patients actifs</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="quick-stats">
                    <i class="bi bi-bell"></i>
                    <div class="quick-stats-info">
                        <h4>5</h4>
                        <p>Notifications</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="row g-4">
            <!-- Upcoming Appointments -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="bi bi-calendar-check"></i> Rendez-vous à venir
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-person"></i> Jean Dupont
                                    <small class="d-block text-muted">Consultation générale</small>
                                </div>
                                <span class="badge badge-appointment rounded-pill">10:00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-person"></i> Marie Martin
                                    <small class="d-block text-muted">Suivi traitement</small>
                                </div>
                                <span class="badge badge-appointment rounded-pill">11:30</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-person"></i> Lucas Moreau
                                    <small class="d-block text-muted">Première consultation</small>
                                </div>
                                <span class="badge badge-appointment rounded-pill">14:00</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="#" class="btn btn-sm btn-outline-success">Voir tous les rendez-vous</a>
                    </div>
                </div>
            </div>

            <!-- Recent Patients -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="bi bi-people"></i> Derniers patients
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-person"></i> Sophie Dubois
                                    <small class="d-block text-muted">Consulté le 12/05/2025</small>
                                </div>
                                <button class="btn btn-sm btn-outline-success">Voir dossier</button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-person"></i> Paul Bernard
                                    <small class="d-block text-muted">Consulté le 10/05/2025</small>
                                </div>
                                <button class="btn btn-sm btn-outline-success">Voir dossier</button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-person"></i> Emma Petit
                                    <small class="d-block text-muted">Consulté le 08/05/2025</small>
                                </div>
                                <button class="btn btn-sm btn-outline-success">Voir dossier</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="#" class="btn btn-sm btn-outline-success">Voir tous les patients</a>
                    </div>
                </div>
            </div>

            <!-- Doctor Profile -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="bi bi-person-circle"></i> Votre Profil
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-person-fill" style="font-size: 2rem;"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0">Dr. <?= htmlspecialchars($_SESSION['email']) ?></h5>
                                <span class="text-muted">Médecine générale</span>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="bi bi-envelope"></i> Email : 
                                <span class="text-muted"><?= htmlspecialchars($_SESSION['email']) ?></span>
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-building"></i> Cabinet : 
                                <span class="text-muted">Centre médical DigitalRDV</span>
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-calendar-week"></i> Disponibilité : 
                                <span class="text-muted">Lun-Ven, 9h-17h</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="#" class="btn btn-sm btn-outline-success">Modifier le profil</a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="bi bi-lightning-charge"></i> Actions rapides
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-success mb-2">
                                <i class="bi bi-plus-circle"></i> Nouveau rendez-vous
                            </a>
                            <a href="#" class="btn btn-outline-success mb-2">
                                <i class="bi bi-file-earmark-medical"></i> Dossiers médicaux
                            </a>
                            <a href="#" class="btn btn-outline-success mb-2">
                                <i class="bi bi-calendar"></i> Gérer les disponibilités
                            </a>
                            <a href="#" class="btn btn-outline-success">
                                <i class="bi bi-chat-dots"></i> Messages
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 DigitalRDV - Tous droits réservés</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>