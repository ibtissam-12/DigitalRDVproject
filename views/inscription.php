<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.png" type="image/gif" />
    <title>Formulaire d'Inscription</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            padding: 30px;
            transition: transform 0.3s ease;
        }
        
        .form-container:hover {
            transform: translateY(-5px);
        }
        
        .form-title {
            color: #00B8A9;
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border 0.3s, box-shadow 0.3s;
        }
        
        .form-input:focus {
            border-color: #00B8A9;
            box-shadow: 0 0 0 2px rgba(0, 184, 169, 0.2);
            outline: none;
        }
        
        .form-input::placeholder {
            color: #aaa;
        }
        
        .submit-btn {
            background-color: #00B8A9;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 14px;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        
        .submit-btn:hover {
            background-color: #00a296;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        
        /* Responsive adjustments */
        @media (max-width: 480px) {
            .form-container {
                padding: 20px;
            }
            
            .form-title {
                font-size: 20px;
            }
            
            .form-input {
                padding: 10px 12px;
            }
            
            .submit-btn {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">INSCRIPTION</h1>
        
        <form action="../controller/UserController.php" method="post">
    <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label for="nom" class="form-label">NOM</label>
                <input type="text" id="nom" name="nom" class="form-input" placeholder="Entrez votre nom" required>
                <span class="error-message" id="nom-error">Veuillez entrer votre nom</span>
            </div>
            <div class="form-group">
                <label for="prenom" class="form-label">PRÉNOM</label>
                <input type="text" id="prenom" name="prenom" class="form-input" placeholder="Entrez votre prénom" required>
                <span class="error-message" id="prenom-error">Veuillez entrer votre prénom</span>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">EMAIL</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="Entrez votre Email" required>
                <span class="error-message" id="email-error">Veuillez entrer une adresse email valide</span>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">MOT DE PASSE</label>
                <input type="password" id="password" name="mot_de_passe" class="form-input" placeholder="Entrez votre mot de passe" required>
                <span class="error-message" id="password-error">Le mot de passe doit contenir au moins 8 caractères</span>
            </div>
            <div class="form-group">
                <label for="confirm-password" class="form-label">CONFIRMER MOT DE PASSE</label>
                <input type="password" id="confirm-password" name="confirmer" class="form-input" placeholder="Confirmez votre mot de passe" required>
                <span class="error-message" id="confirm-password-error">Les mots de passe ne correspondent pas</span>
            </div>
            <div class="form-group">
                <label for="role" class="form-label">RÔLE</label>
                <select id="role" name="role" class="form-input" required>
                    <option value="patient">Patient</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">S'INSCRIRE</button>
        </form>
        
    </div>

    <script>
        document.getElementById('registration-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Reset error messages
            document.querySelectorAll('.error-message').forEach(element => {
                element.style.display = 'none';
            });
            
            // Get form values
            const nom = document.getElementById('nom').value.trim();
            const prenom = document.getElementById('prenom').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            // Validate form fields
            let isValid = true;
            
            if (!nom) {
                document.getElementById('nom-error').style.display = 'block';
                isValid = false;
            }
            
            if (!prenom) {
                document.getElementById('prenom-error').style.display = 'block';
                isValid = false;
            }
            
            // Simple email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailRegex.test(email)) {
                document.getElementById('email-error').style.display = 'block';
                isValid = false;
            }
            
            // Password validation (at least 8 characters)
            if (!password || password.length < 8) {
                document.getElementById('password-error').style.display = 'block';
                isValid = false;
            }
            
            // Confirm password validation
            if (password !== confirmPassword) {
                document.getElementById('confirm-password-error').style.display = 'block';
                isValid = false;
            }
            
            // If form is valid, you can submit it
            if (isValid) {
                console.log('Form is valid, submitting...');
                // Here you would typically send the form data to your server
                // You can replace this with your actual form submission code
                window.location.href = "accueil.php";
                alert('Inscription réussie!');
                this.reset();
            }
        });
    </script>
</body>
</html>

