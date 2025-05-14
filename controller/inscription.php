<?php
require_once __DIR__ . '/../model/user.php';

class InscriptionController {
    public function inscrireUtilisateur() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $mdp = $_POST['mot_de_passe'];
            $confirm = $_POST['confirmer'];
            $role = $_POST['role'];

            if ($mdp !== $confirm) {
                echo "Les mots de passe ne correspondent pas.";
                return;
            }

            $user = new Utilisateur();
            $success = $user->inscrire($nom, $prenom, $email, $mdp, $role);

            if ($success) {
                echo "Inscription réussie.";
                header("Location: accueil.php");
                exit;
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }
}
?>




