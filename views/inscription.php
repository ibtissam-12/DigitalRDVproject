<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="images/logo.png" type="image/gif" />
    <title>Formulaire d'Inscription</title>
    <style>
        /* Styles inchangés */
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
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }
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

        <?php
        // Affiche le message d'erreur s'il existe dans l'URL
        if (isset($_GET['error'])) {
            // Sécuriser l'affichage avec htmlspecialchars
            $error = htmlspecialchars($_GET['error']);
            echo "<div class='error-message'>$error</div>";
        }
        ?>

        <form action="../controller/userController.php" method="post" id="registration-form">
            <input type="hidden" name="action" value="register" />
            <div class="form-group">
                <label for="nom" class="form-label">NOM</label>
                <input type="text" id="nom" name="nom" class="form-input" placeholder="Entrez votre nom" required />
            </div>
            <div class="form-group">
                <label for="prenom" class="form-label">PRÉNOM</label>
                <input type="text" id="prenom" name="prenom" class="form-input" placeholder="Entrez votre prénom" required />
            </div>
            <div class="form-group">
                <label for="email" class="form-label">EMAIL</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="Entrez votre Email" required />
            </div>
            <div class="form-group">
                <label for="password" class="form-label">MOT DE PASSE</label>
                <input type="password" id="password" name="mot_de_passe" class="form-input" placeholder="Entrez votre mot de passe" required />
            </div>
            <div class="form-group">
                <label for="confirm-password" class="form-label">CONFIRMER MOT DE PASSE</label>
                <input type="password" id="confirm-password" name="confirmer" class="form-input" placeholder="Confirmez votre mot de passe" required />
            </div>
            <button type="submit" class="submit-btn">S'INSCRIRE</button>
        </form>
    </div>

    <script>
        // Optionnel : validation JS côté client
        document.getElementById('registration-form').addEventListener('submit', function (event) {
            // Pas de prévention de l'envoi ici, laisse le serveur gérer les erreurs côté backend
        });
    </script>
</body>
</html>

