<?php
require_once '../model/user.php';
session_start();

class UserController {
    private $user;
    
    public function __construct() {
        $this->user = new User();
    }
    
    /**
     * Handle user registration
     */
    public function register($nom, $prenom, $email, $mot_de_passe, $confirmer) {
        $result = $this->user->register($nom, $prenom, $email, $mot_de_passe, $confirmer);
        
        if ($result === true) {
            return ["success" => true, "redirect" => "../views/registrationSucces.html"];
        } else {
            return ["success" => false, "message" => $result];
        }
    }
    
    /**
     * Handle user login
     */
    public function login($email, $mot_de_passe) {
        $userData = $this->user->login($email, $mot_de_passe);
        
        if ($userData) {
            // Store user data in session
            $_SESSION['user'] = $userData;
            $_SESSION['user_id'] = $userData['id'] ?? null;
            $_SESSION['user_email'] = $userData['email'] ?? null;
            $_SESSION['user_name'] = ($userData['prenom'] ?? '') . ' ' . ($userData['nom'] ?? '');
            $_SESSION['logged_in'] = true; // Important flag to check login status
            
            return ["success" => true, "redirect" => "../views/accueil.php"];
        }
        
        return ["success" => false, "message" => "Email ou mot de passe incorrect."];
    }
    
    /**
     * Handle Google login
     */
    public function loginWithGoogle($googleToken) {
        $userData = $this->user->loginWithGoogle($googleToken);
        
        if ($userData) {
            // Store Google user data in session
            $_SESSION['user'] = $userData;
            $_SESSION['user_id'] = $userData['id'] ?? null;
            $_SESSION['user_email'] = $userData['email'] ?? null;
            $_SESSION['user_name'] = $userData['nom'] ?? '';
            $_SESSION['logged_in'] = true;
            
            return ["success" => true, "redirect" => "../views/accueil.php"];
        }
        
        return ["success" => false, "message" => "Erreur lors de la connexion Google."];
    }
    
    /**
     * Handle password reset
     */
    public function resetPassword($email, $nouveau_mdp, $confirmer) {
        if ($nouveau_mdp !== $confirmer) {
            return ["success" => false, "message" => "Les mots de passe ne correspondent pas !"];
        }
        
        $result = $this->user->resetPassword($email, $nouveau_mdp);
        
        if ($result === true) {
            return ["success" => true, "redirect" => "../views/login.php?success=1"];
        } else {
            return ["success" => false, "message" => $result];
        }
    }
    
    /**
     * Check if user is logged in
     */
    public static function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
    
    /**
     * Get current user data
     */
    public static function getCurrentUser() {
        return $_SESSION['user'] ?? null;
    }
}

// Process incoming requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    
    // Action d'inscription
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';
        $confirmer = $_POST['confirmer'] ?? '';
        
        $result = $controller->register($nom, $prenom, $email, $mot_de_passe, $confirmer);
        
        if ($result["success"]) {
            header('Location: ' . $result["redirect"]);
            exit;
        } else {
            $error = urlencode($result["message"]);
            header("Location: ../views/inscription.php?error=$error");
            exit;
        }
    }
    
    // Action de connexion
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $email = $_POST['email'] ?? '';
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';
        
        $result = $controller->login($email, $mot_de_passe);
        echo json_encode($result);
        exit;
    }
    
    // Action de réinitialisation du mot de passe
    if (isset($_POST['action']) && $_POST['action'] === 'reset_password') {
        $email = $_POST['email'] ?? '';
        $nouveau_mdp = $_POST['nouveau_mdp'] ?? '';
        $confirmer = $_POST['confirmer'] ?? '';
        
        $result = $controller->resetPassword($email, $nouveau_mdp, $confirmer);
        
        if ($result["success"]) {
            header('Location: ' . $result["redirect"]);
            exit;
        } else {
            $error = urlencode($result["message"]);
            header("Location: ../views/passwordReset.html?error=$error");
            exit;
        }
    }
    
    // Connexion via Google
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if (isset($data['credential'])) {
        $googleToken = $data['credential'];
        $result = $controller->loginWithGoogle($googleToken);
        echo json_encode($result);
        exit;
    }
}
?>