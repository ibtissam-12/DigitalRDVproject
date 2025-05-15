<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Page de Connexion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
    />
    <style>
        html, body {
            height: 100%;
        }
        body {
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            padding: 32px 28px 28px 28px;
            border-radius: 18px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.12);
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-control {
            border-radius: 10px;
            padding-left: 40px;
        }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            background: white;
        }
        .btn {
            border-radius: 10px;
            transition: all 0.3s;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .toggle-password {
            cursor: pointer;
        }
        .google-btn {
            background-color: white;
            color: #444;
            border: 1px solid #ddd;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin-top: 10px;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
        }
        .google-btn:hover {
            background-color: #f5f5f5;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .google-btn img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }
        .d-flex.align-items-center.my-3 {
            width: 100%;
        }
        .signup-link {
            margin-top: 20px;
            width: 100%;
        }
        @media (max-width: 500px) {
            .login-container {
                padding: 18px 6px;
            }
        }
    </style>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>
    <div class="login-container text-center">
        <h2 class="text-success mb-4">CONNEXION</h2>
        <form class="w-100" onsubmit="return handleLogin(event)">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="Entrez votre Email"
                  name="email"
                  required
                />
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input
                  type="password"
                  id="password"
                  class="form-control"
                  placeholder="Entrez votre mot de passe"
                  name="password"
                  required
                />
                <span class="input-group-text toggle-password" onclick="togglePassword()">
                    <i class="bi bi-eye"></i>
                </span>
            </div>
            <div class="text-end w-100 mb-2">
                <a href="passwordReset.html" class="text-danger text-decoration-none small">Mot de passe oublié ?</a>
            </div>
            <button type="submit" class="btn btn-success w-100 mt-2" name="action">SE CONNECTER</button>
        </form>

        <div class="d-flex align-items-center my-3">
            <hr class="flex-grow-1" /> <span class="mx-2">OU</span> <hr class="flex-grow-1" />
        </div>

        <!-- Google Sign-In Button -->

        <div
          id="g_id_onload"
          data-client_id="679790544294-0h193q32m4urv5acdo9hm3bju94q4qdt.apps.googleusercontent.com"
          data-login_uri="http://localhost:8080/google-callback.php"
          data-callback="handleCredentialResponse"
          data-auto_prompt="false"
        ></div>

        <div
          class="g_id_signin"
          data-type="standard"
          data-shape="rectangular"
          data-theme="outline"
          data-text="signin_with"
          data-size="large"
          data-logo_alignment="left"
          data-width="full"
          data-local_hint="fr"
        ></div>
        <!-- Sign Up Link -->
        <div class="signup-link">
            <a href="inscription.php" class="btn btn-outline-success w-100 mt-3"
              >PAS DE COMPTE ? S'INSCRIRE</a
            >
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function handleLogin(event) {
            event.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            if (email === "" || password === "") {
                alert("Veuillez remplir tous les champs.");
                return false;
            }

            // Envoi des données à UserController.php
            fetch("UserController.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body:
                    "email=" +
                    encodeURIComponent(email) +
                    "&password=" +
                    encodeURIComponent(password) +
                    "&action=login", // <-- Ajout ici
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data); // debug
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Erreur lors de la connexion");
                });

            return false;
        }

        function togglePassword() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.querySelector(".toggle-password i");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            }
        }

        function handleCredentialResponse(response) {
            console.log("ID token Google :", response.credential);

            fetch("login-google.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ credential: response.credential }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        alert("Erreur lors de la connexion Google");
                    }
                });
        }
    </script>
</body>
</html>



