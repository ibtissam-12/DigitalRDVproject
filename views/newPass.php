<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.png" type="image/gif" />
    <title>Nouveau mot de passe</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .password-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 30px;
            transition: transform 0.3s ease;
        }
        
        .password-container:hover {
            transform: translateY(-5px);
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
        
        .password-strength {
            height: 5px;
            background-color: #eee;
            border-radius: 3px;
            margin-top: 8px;
            overflow: hidden;
        }
        
        .password-strength-meter {
            height: 100%;
            width: 0;
            background-color: #ccc;
            transition: width 0.3s, background-color 0.3s;
        }
        
        /* Responsive adjustments */
        @media (max-width: 480px) {
            .password-container {
                padding: 20px;
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
    <div class="password-container">
       <form action="../controller/userController.php" method="post">
    <input type="hidden" name="action" value="change_password" />
    <input type="hidden" name="email" value="UTILISATEUR_EMAIL_OU_TOKEN" />
    <div class="form-group">
        <label for="new-password" class="form-label">Nouveau mot de passe</label>
        <input type="password" name="nouveau_mdp" class="form-input" required>
    </div>
    <div class="form-group">
        <label for="confirm-password" class="form-label">Confirmer mot de passe</label>
        <input type="password" name="confirmer" class="form-input" required>
    </div>
    <button type="submit" class="submit-btn">Enregistrer</button>
</form>
    </div>

    <script>
        // Password strength meter
        const passwordInput = document.getElementById('new-password');
        const passwordMeter = document.getElementById('password-meter');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]+/)) strength += 25;
            if (password.match(/[A-Z]+/)) strength += 25;
            if (password.match(/[0-9]+/) || password.match(/[^a-zA-Z0-9]+/)) strength += 25;
            
            passwordMeter.style.width = strength + '%';
            
            if (strength <= 25) {
                passwordMeter.style.backgroundColor = '#e74c3c'; // Weak
            } else if (strength <= 50) {
                passwordMeter.style.backgroundColor = '#f39c12'; // Medium
            } else if (strength <= 75) {
                passwordMeter.style.backgroundColor = '#3498db'; // Strong
            } else {
                passwordMeter.style.backgroundColor = '#2ecc71'; // Very strong
            }
        });
        
        // Form validation
        document.getElementById('new-password-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Reset error messages
            document.querySelectorAll('.error-message').forEach(element => {
                element.style.display = 'none';
            });
            
            const newPassword = passwordInput.value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            let isValid = true;
            
            // Password validation
            if (newPassword.length < 8) {
                document.getElementById('password-error').style.display = 'block';
                isValid = false;
            }
            
            // Confirm password validation
            if (newPassword !== confirmPassword) {
                document.getElementById('confirm-error').style.display = 'block';
                isValid = false;
            }
            
            if (isValid) {
                console.log('Password successfully changed');
                // Here you would send the new password to your server
                
                // Redirect to success page
                window.location.href = 'changeSucces.html';
            }
        });
    </script>
</body>
</html>