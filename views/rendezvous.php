<?php
if (isset($_POST['ajax']) && $_POST['ajax'] == '1' && isset($_POST['date'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=digitalrdv;charset=utf8', 'root', '');
    $date = $_POST['date'];
    $stmt = $pdo->prepare("SELECT heure FROM rendezvous WHERE date = ?");
    $stmt->execute([$date]);
    $reservedSlots = $stmt->fetchAll(PDO::FETCH_COLUMN);
    header('Content-Type: application/json');
    echo json_encode($reservedSlots);
    exit;
}


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

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=digitalrdv;charset=utf8', 'root', '');

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['date'], $_POST['time'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM rendezvous WHERE date = ? AND heure = ?");
    $stmt->execute([$date, $time]);

    if ($stmt->fetchColumn() == 0) {
        $stmt = $pdo->prepare("INSERT INTO rendezvous (utilisateur_id, nom, email, date, heure, statut) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $name, $email, $date, $time, 'prévu']);
        $success = true;
    }
}

// Récupère les réservations pour la date sélectionnée (si AJAX, sinon pour la date du jour)
$reservedSlots = [];
if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $stmt = $pdo->prepare("SELECT heure FROM rendezvous WHERE date = ?");
    $stmt->execute([$date]);
    $reservedSlots = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un rendez-vous</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
     <link rel="icon" href="images/logo.png" type="image/gif" />
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
            padding: 30px 40px 30px 40px;
            margin: 0 auto;
        }
        /* Style personnalisé pour le titre principal */
        h1 {
            text-align: center;
            color: #00BFA5;
            margin-bottom: 35px;
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px rgba(0,191,165,0.07);
            font-family: 'Poppins', Arial, sans-serif;
        }
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        .calendar {
            margin-top: 20px;
        }
        .month-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .month-title {
            font-weight: bold;
            font-size: 18px;
        }
        .nav-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            color: #00BFA5;
        }
        .weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }
        .day {
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 50%;
        }
        .day:hover:not(.disabled) {
            background-color: #e0f2f1;
        }
        .day.selected {
            background-color: #00BFA5;
            color: white;
        }
        .day.disabled {
            color: #ccc;
            cursor: not-allowed;
        }
        .time-slots {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
        .time-slot {
            text-align: center;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }
        .time-slot:hover {
            background-color: #e9f7f6;
            border-color: #00BFA5;
        }
        .time-slot.selected {
            background-color: #00BFA5;
            color: white;
            border-color: #00BFA5;
        }
        .time-slot.disabled {
            background-color: #eee !important;
            color: #aaa !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
            border-color: #ccc !important;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .next-btn {
            background-color: #00BFA5;
            color: white;
        }
        .next-btn:hover {
            background-color: #00a896;
        }
        .back-btn {
            background-color: #f1f1f1;
            color: #333;
        }
        .back-btn:hover {
            background-color: #e5e5e5;
        }
        .hidden {
            display: none;
        }
        .confirmation {
            text-align: center;
            line-height: 1.6;
        }
        .confirmation-details {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        /* NAVBAR */
        .navbar {
            background-color: rgba(255,255,255,0.95) !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 2px 0;
            transition: all 0.3s ease;
        }
        .navbar-brand img {
            height: 28px;
            max-height: 28px;
            transition: transform 0.3s ease;
        }
        .navbar-brand img:hover {
            transform: scale(1.05);
        }
        .navbar .nav-link {
            font-size: 0.97rem;
            padding: 6px 10px;
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
        /* FOOTER */
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
    </style>
</head>
<body>
    <!-- NAVBAR -->
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
    <div style="height:30px"></div>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-12">
          <h1>Prendre un rendez-vous</h1>
          <?php if (!isset($success)): ?>
          <form method="post" id="rdv-form">
            <!-- Étape 1: Informations personnelles -->
            <div class="step active" id="step1">
                <h2>Vos informations</h2>
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" id="name" name="name" placeholder="Votre nom complet">
                </div>
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" placeholder="Votre adresse email">
                </div>
                <div class="buttons">
                    <div></div>
                    <button type="button" class="next-btn" onclick="nextStep()" id="info-next">Suivant</button>
                </div>
            </div>
            
            <!-- Étape 2: Sélection de la date -->
            <div class="step" id="step2">
                <h2>Sélectionnez une date</h2>
                <div class="calendar">
                    <div class="month-nav">
                        <button class="nav-btn" type="button" onclick="prevMonth()">&lt;</button>
                        <div class="month-title" id="month-year">Mai 2025</div>
                        <button class="nav-btn" type="button" onclick="nextMonth()">&gt;</button>
                    </div>
                    <div class="weekdays">
                        <div>L</div>
                        <div>M</div>
                        <div>M</div>
                        <div>J</div>
                        <div>V</div>
                        <div>S</div>
                        <div>D</div>
                    </div>
                    <div class="days" id="days-grid"></div>
                </div>
                <div class="buttons">
                    <button type="button" class="back-btn" onclick="prevStep()">Retour</button>
                    <button type="button" class="next-btn" onclick="nextStep()" id="date-next" disabled>Suivant</button>
                </div>
            </div>
            
            <!-- Étape 3: Sélection de l'heure -->
            <div class="step" id="step3">
                <h2>Choisissez un horaire</h2>
                <div class="time-slots" id="time-slots">
                    <div class="time-slot" onclick="selectTimeSlot(this)">09:00</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">09:30</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">10:00</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">10:30</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">11:00</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">11:30</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">14:00</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">14:30</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">15:00</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">15:30</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">16:00</div>
                    <div class="time-slot" onclick="selectTimeSlot(this)">16:30</div>
                </div>
                <div class="buttons">
                    <button type="button" class="back-btn" onclick="prevStep()">Retour</button>
                    <button type="button" class="next-btn" onclick="nextStep()" id="time-next" disabled>Confirmer</button>
                </div>
            </div>
            
            <!-- Étape 4: Confirmation -->
            <div class="step" id="step4">
                <h2>Confirmation du rendez-vous</h2>
                <div class="confirmation">
                    <p>Votre rendez-vous a été programmé avec succès!</p>
                    <div class="confirmation-details">
                        <p><strong>Nom:</strong> <span id="confirm-name"></span></p>
                        <p><strong>Email:</strong> <span id="confirm-email"></span></p>
                        <p><strong>Date:</strong> <span id="confirm-date"></span></p>
                        <p><strong>Heure:</strong> <span id="confirm-time"></span></p>
                    </div>
                    <p>Un e-mail de confirmation vous a été envoyé.</p>
                </div>
                <div class="buttons">
                    <button type="button" class="back-btn" onclick="resetForm()">Nouveau rendez-vous</button>
                </div>
            </div>

            <!-- Champs cachés pour la date et l'heure -->
            <input type="hidden" name="date" id="hidden-date">
            <input type="hidden" name="time" id="hidden-time">
          </form>
          <?php endif; ?>
          <?php if (isset($success) && $success): ?>
            <div class="alert alert-success text-center" style="margin-top:30px;">
                <h2>Confirmation du rendez-vous</h2>
                <div class="confirmation-details" style="background:#f9f9f9;border:1px solid #ddd;border-radius:5px;padding:15px;margin:20px 0;text-align:left;display:inline-block;">
                    <p><strong>Nom:</strong> <?php echo htmlspecialchars($_POST['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($_POST['email']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($_POST['date']); ?></p>
                    <p><strong>Heure:</strong> <?php echo htmlspecialchars($_POST['time']); ?></p>
                </div>
                <p>Votre rendez-vous a bien été enregistré !<br>Un e-mail de confirmation vous a été envoyé.</p>
            </div>
          <?php endif; ?>
          <?php if (isset($error)): ?>
  <div class="alert alert-danger text-center" style="margin-top:30px;">
    <?php echo htmlspecialchars($error); ?>
  </div>
<?php endif; ?>
        </div>
      </div>
    </div>

    <!-- FOOTER -->
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
function nextStep() {
    // Étape 1 -> Étape 2
    if (document.getElementById('step1').classList.contains('active')) {
        var name = document.getElementById('name').value.trim();
        var email = document.getElementById('email').value.trim();
        if (!name || !email) {
            alert('Veuillez remplir tous les champs.');
            return;
        }
        document.getElementById('step1').classList.remove('active');
        document.getElementById('step2').classList.add('active');
        return;
    }
    // Étape 2 -> Étape 3
    if (document.getElementById('step2').classList.contains('active')) {
        if (!window.selectedDate) {
            alert('Veuillez sélectionner une date.');
            return;
        }
        document.getElementById('step2').classList.remove('active');
        document.getElementById('step3').classList.add('active');
        // Recharge les créneaux réservés pour la date sélectionnée
        fetchReservedSlots(window.selectedDate, function(slots) {
            window.reservedSlots = slots;
            renderTimeSlots();
        });
        return;
    }
    // Étape 3 -> Étape 4 (confirmation)
    if (document.getElementById('step3').classList.contains('active')) {
        if (!window.selectedTime) {
            alert('Veuillez sélectionner une heure.');
            return;
        }
        // Affiche les infos de confirmation
        document.getElementById('confirm-name').textContent = document.getElementById('name').value;
        document.getElementById('confirm-email').textContent = document.getElementById('email').value;
        document.getElementById('confirm-date').textContent = window.selectedDate;
        document.getElementById('confirm-time').textContent = window.selectedTime;
        document.getElementById('step3').classList.remove('active');
        document.getElementById('step4').classList.add('active');

        // Remplis les champs cachés
        document.getElementById('hidden-date').value = window.selectedDate;
        document.getElementById('hidden-time').value = window.selectedTime;
        // Soumets le formulaire
        document.getElementById('rdv-form').submit();
        return;
    }
}
    </script>
    <script>
const daysGrid = document.getElementById('days-grid');
const monthYear = document.getElementById('month-year');
let currentDate = new Date();

function renderCalendar(date = new Date()) {
    daysGrid.innerHTML = '';
    document.getElementById('date-next').disabled = true;
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1).getDay() || 7;
    const lastDate = new Date(year, month + 1, 0).getDate();

    // Affiche le mois/année
    const monthNames = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
    monthYear.textContent = `${monthNames[month]} ${year}`;

    // Ajoute des cases vides pour aligner le 1er jour
    for (let i = 1; i < firstDay; i++) {
        const empty = document.createElement('div');
        daysGrid.appendChild(empty);
    }

    // Ajoute les jours du mois
    for (let d = 1; d <= lastDate; d++) {
        const dayDiv = document.createElement('div');
        dayDiv.className = 'day';
        dayDiv.textContent = d;
        dayDiv.onclick = function() {
            // Sélectionne le jour
            document.querySelectorAll('.day').forEach(el => el.classList.remove('selected'));
            dayDiv.classList.add('selected');
            // Active le bouton "Suivant"
            document.getElementById('date-next').disabled = false;
            // Stocke la date sélectionnée
            window.selectedDate = `${year}-${String(month+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;

            // Appel AJAX pour charger les créneaux réservés de ce jour
            fetchReservedSlots(window.selectedDate, function(slots) {
                window.reservedSlots = slots;
                renderTimeSlots();
            });
        };
        daysGrid.appendChild(dayDiv);
    }
}

// Navigation mois précédent/suivant
function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
}
function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
}

// Affiche le calendrier au chargement
if (daysGrid && monthYear) {
    renderCalendar(currentDate);
}
    </script>
    <script>
function selectTimeSlot(el) {
    // Retire la sélection précédente
    document.querySelectorAll('.time-slot').forEach(e => e.classList.remove('selected'));
    // Ajoute la classe sélectionnée à l'élément cliqué
    el.classList.add('selected');
    // Stocke l'heure sélectionnée
    window.selectedTime = el.textContent.trim();
    // Active le bouton "Confirmer"
    document.getElementById('time-next').disabled = false;
}
    </script>
    <script>
function renderTimeSlots() {
    document.querySelectorAll('.time-slot').forEach(slot => {
        // Normalise le format pour comparer "15:00" et "15:00:00"
        const slotTime = slot.textContent.trim();
        const slotTimeFull = slotTime.length === 5 ? slotTime + ':00' : slotTime;
        if (window.reservedSlots && window.reservedSlots.includes(slotTimeFull)) {
            slot.classList.add('disabled');
            slot.onclick = null;
        } else {
            slot.classList.remove('disabled');
            slot.onclick = function() { selectTimeSlot(this); };
        }
    });
}
    </script>
    <script>
    window.reservedSlots = [];
</script>
    <script>
function fetchReservedSlots(date, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'rendezvous.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                callback(data);
            } catch (e) {
                callback([]);
            }
        }
    };
    xhr.send('ajax=1&date=' + encodeURIComponent(date));
}
    </script>
    <script>
window.addEventListener('DOMContentLoaded', function() {
    if (window.selectedDate) {
        fetchReservedSlots(window.selectedDate, function(slots) {
            window.reservedSlots = slots;
            renderTimeSlots();
        });
    }
});
    </script>
    <script>
function prevStep() {
    if (document.getElementById('step2').classList.contains('active')) {
        // Retour à l'étape 1
        document.getElementById('step2').classList.remove('active');
        document.getElementById('step1').classList.add('active');
    } else if (document.getElementById('step3').classList.contains('active')) {
        // Retour à l'étape 2
        document.getElementById('step3').classList.remove('active');
        document.getElementById('step2').classList.add('active');
    } else if (document.getElementById('step4').classList.contains('active')) {
        // Retour à l'étape 3
        document.getElementById('step4').classList.remove('active');
        document.getElementById('step3').classList.add('active');
    }
}
    </script>

</body>
</html>