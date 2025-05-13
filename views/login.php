<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalRDV - Connexion</title>
    <link rel="icon" href="images/logo.png" type="image/gif" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            display: flex;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            width: 800px;
            background-color: white;
        }
        .login-image {
            flex: 1;
            background-image: url('medical-illustration.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-form {
            flex: 1;
            padding: 40px;
        }
        h1 {
            color: #4CAF50;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        .toggle-container {
            display: flex;
            margin-bottom: 20px;
        }
        .toggle-btn {
            flex: 1;
            padding: 10px;
            text-align: center;
            background-color: #f1f1f1;
            cursor: pointer;
        }
        .toggle-btn.active {
            background-color: #4CAF50;
            color: white;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            height: 60px;
        }
        .google-btn img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .text-end {
            text-align: end;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-image">
                <!-- Illustration médicale ici -->
            </div>
            <div class="login-form">
                <div class="logo">
                    <img src="logo.png" alt="DigitalRDV Logo">
                    <h1>DigitalRDV</h1>
                </div>
                <div class="toggle-container">
                    <div class="toggle-btn active" id="patient-toggle">Patient</div>
                    <div class="toggle-btn" id="doctor-toggle">Médecin</div>
                </div>
                <form id="login-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" required>
                    </div>
                    <div class="text-end">
                        <a href="passwordReset.html" class="text-danger text-decoration-none">Mot de passe oublié ?</a>
                    </div>
                    <button type="submit">Se connecter</button>
                    <p id="register-link" class="mt-3">Pas encore de compte? <a href="inscription.html">S'inscrire</a></p>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const patientToggle = document.getElementById('patient-toggle');
            const doctorToggle = document.getElementById('doctor-toggle');
            const registerLink = document.getElementById('register-link');
            const loginForm = document.getElementById('login-form');
            
            // Toggle between patient and doctor login
            patientToggle.addEventListener('click', function() {
                patientToggle.classList.add('active');
                doctorToggle.classList.remove('active');
                registerLink.style.display = 'block';
            });
            
            doctorToggle.addEventListener('click', function() {
                doctorToggle.classList.add('active');
                patientToggle.classList.remove('active');
                registerLink.style.display = 'none'; // Les médecins ne s'inscrivent pas eux-mêmes
            });
            
            // Form submission
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const isDoctor = doctorToggle.classList.contains('active');
                
                if (email === "" || password === "") {
                    alert("Veuillez remplir tous les champs.");
                    return false;
                }
                // Redirection selon le type d'utilisateur
                if (isDoctor) {
                    window.location.href = 'doctor-dashboard.html';
                } else {
                    window.location.href = 'patient-dashboard.html';
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
