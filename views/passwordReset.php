<?php
session_start();

if (!isset($_SESSION['user'])) {
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
    <title>Réinitialisation mot de passe</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background:  #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .reset-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 30px;
            transition: transform 0.3s ease;
        }
        
        .reset-container:hover {
            transform: translateY(-5px);
        }
        
        .reset-title {
            color: #00B8A9;
            margin-bottom: 25px;
            font-size: 20px;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
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
            .reset-container {
                padding: 20px;
            }
            
            .reset-title {
                font-size: 18px;
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
    <div class="reset-container">
        <h1 class="reset-title">Réinitialisation mot de passe</h1>
        
        <form id="reset-form">
            <div class="form-group">
                <input type="text" id="email-or-phone" class="form-input" placeholder="Entrez votre Email ou numéro de téléphone" required>
                <span class="error-message" id="email-error">Veuillez entrer une adresse email ou numéro valide</span>
            </div>
            
            <button href="verificationducode.html" type="submit" class="submit-btn">Suivant</button>
        </form>
    </div>

    <script>
        document.getElementById('reset-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Reset error messages
            document.querySelectorAll('.error-message').forEach(element => {
                element.style.display = 'none';
            });
            
            // Get form value
            const emailOrPhone = document.getElementById('email-or-phone').value.trim();
            
            // Validate form field
            let isValid = true;
            
            // Simple email or phone validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phoneRegex = /^\d{10,15}$/;
            
            if (!emailOrPhone || (!emailRegex.test(emailOrPhone) && !phoneRegex.test(emailOrPhone))) {
                document.getElementById('email-error').style.display = 'block';
                isValid = false;
            }
            
            // If form is valid, proceed to the next step
            if (isValid) {
                console.log('Form is valid, proceeding to verification code step...');
                // Here you would typically redirect to the verification page
                // or trigger sending of the verification code
                
                // Redirect to verification code page (you'll need to adjust this URL)
                 window.location.href = "verificationducode.html";
                
                // For demo purposes, alert instead of redirect
                alert('Code de vérification envoyé!');
            }
        });
    </script>
</body>
</html>