<?php
namespace App\Core;

/**
 * Contrôleur de base
 */
class Controller
{
    /**
     * Charge une vue
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/' . $view . '.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    /**
     * Redirection avec message flash
     */
    protected function redirect(string $url, string $message = '', string $type = 'success'): void
    {
        if ($message) {
            $_SESSION['flash'] = ['message' => $message, 'type' => $type];
        }
        header('Location: ' . $url);
        exit;
    }

    /**
     * Vérifie si l'utilisateur est connecté
     */
    protected function requireLogin(): void
    {
        if (empty($_SESSION['user'])) {
            $this->redirect('/login', 'Vous devez être connecté', 'danger');
        }
    }

    /**
     * Vérifie si l'utilisateur est admin
     */
    protected function requireAdmin(): void
    {
        $this->requireLogin();
        if ($_SESSION['user']['role'] !== 'admin') {
            $this->redirect('/', 'Accès réservé aux administrateurs', 'danger');
        }
    }
}