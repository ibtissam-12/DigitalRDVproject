<?php
require_once '../model/user.php';
session_start();

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Action d'inscription
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';
         $confirmer = $_POST['confirmer'] ?? '';

        $result = $user->register($nom, $prenom, $email, $mot_de_passe,$confirmer);

        if ($result === true) {
            header('Location: ../views/registrationSucces.html');
            exit;
        } else {
            $error = urlencode($result);
            header("Location: ../views/inscription.php?error=$error");
            exit;
        }
    }

    // Action de connexion
    if ($_POST['action'] === 'login') {
        $email = $_POST['email'] ?? '';
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';

        $result = $user->login($email, $mot_de_passe);

        if ($result) {
            $_SESSION['user'] = $result;

            // Envoi d'une réponse JSON avec redirection selon le rôle (si souhaité)
            echo json_encode([
                'success' => true,
                'redirect' => '../views/accueil.php'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Email ou mot de passe incorrect.'
            ]);
        }
        exit;
    }

    // Connexion via Google (exemple simple)
//     $json = file_get_contents('php://input');
//     $data = json_decode($json, true);

//     if (isset($data['credential'])) {
//         $googleToken = $data['credential'];

//         // À implémenter dans User.php : méthode loginWithGoogle()
//         $result = $user->loginWithGoogle($googleToken);

//         if ($result) {
//             $_SESSION['user'] = $result;
//             echo json_encode([
//                 'success' => true,
//                 'redirect' => '../views/accueil.php'
//             ]);
//         } else {
//             echo json_encode([
//                 'success' => false,
//                 'message' => 'Erreur lors de la connexion Google.'
//             ]);
//         }
//         exit;
//     }
// }
if (isset($_POST['action']) && $_POST['action'] === 'reset_password') {
    $email = $_POST['email'] ?? '';
    $nouveau_mdp = $_POST['nouveau_mdp'] ?? '';
    $confirmer = $_POST['confirmer'] ?? '';

    if ($nouveau_mdp !== $confirmer) {
        $error = urlencode("Les mots de passe ne correspondent pas !");
        header("Location: ../views/passwordReset.php?error=$error");
        exit;
    }

    $result = $user->resetPassword($email, $nouveau_mdp);

    if ($result === true) {
        header('Location: ../views/passwordReset.php?success=1');
        exit;
    } else {
        $error = urlencode($result);
        header("Location: ../views/passwordReset.php?error=$error");
        exit;
    }
}

session_start();

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Changement de mot de passe après vérification du code
    if (isset($_POST['action']) && $_POST['action'] === 'change_password') {
        $email = $_POST['email'] ?? ''; // ou $_SESSION['reset_email'] si tu utilises une session
        $nouveau_mdp = $_POST['nouveau_mdp'] ?? '';
        $confirmer = $_POST['confirmer'] ?? '';

        if (empty($email) || empty($nouveau_mdp) || empty($confirmer)) {
            header('Location: ../views/newPass.html?error=Champs manquants');
            exit;
        }

        if ($nouveau_mdp !== $confirmer) {
            header('Location: ../views/newPass.html?error=Les mots de passe ne correspondent pas');
            exit;
        }

        $result = $user->resetPassword($email, $nouveau_mdp);

        if ($result === true) {
            header('Location: ../views/changeSucces.html');
            exit;
        } else {
            header('Location: ../views/newPass.html?error=' . urlencode($result));
            exit;
        }
    }
}
}
?>



