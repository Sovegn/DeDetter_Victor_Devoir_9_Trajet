<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

/**
 * Contrôleur d'authentification
 */
class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function loginForm(): void
    {
        if (!empty($_SESSION['user'])) {
            $this->redirect('/');
        }
        $this->render('auth/login');
    }

    /**
     * Traite la connexion
     */
    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user'] = [
                'id'     => $user['id_utilisateur'],
                'nom'    => $user['nom'],
                'prenom' => $user['prenom'],
                'email'  => $user['email'],
                'role'   => $user['role']
            ];
            $this->redirect('/', 'Connexion réussie');
        }

        $this->redirect('/login', 'Email ou mot de passe incorrect', 'danger');
    }

    /**
     * Déconnexion
     */
    public function logout(): void
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}