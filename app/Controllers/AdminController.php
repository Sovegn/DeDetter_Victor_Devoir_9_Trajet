<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Agence;
use App\Models\Trajet;

/**
 * Contrôleur administrateur
 */
class AdminController extends Controller
{
    /**
     * Tableau de bord admin
     */
    public function dashboard(): void
    {
        $this->requireAdmin();
        $this->render('admin/dashboard');
    }

    /**
     * Liste des utilisateurs
     */
    public function utilisateurs(): void
    {
        $this->requireAdmin();
        $users = User::all();
        $this->render('admin/utilisateurs', ['users' => $users]);
    }

    /**
     * Liste des agences
     */
    public function agences(): void
    {
        $this->requireAdmin();
        $agences = Agence::all();
        $this->render('admin/agences', ['agences' => $agences]);
    }

    /**
     * Création d'une agence
     */
    public function createAgence(): void
    {
        $this->requireAdmin();
        $nom = trim($_POST['nom'] ?? '');
        if ($nom && Agence::create($nom)) {
            $this->redirect('/admin/agences', 'Agence créée');
        }
        $this->redirect('/admin/agences', 'Erreur', 'danger');
    }

    /**
     * Suppression d'une agence
     */
    public function deleteAgence(int $id): void
    {
        $this->requireAdmin();
        if (Agence::delete($id)) {
            $this->redirect('/admin/agences', 'Agence supprimée');
        }
        $this->redirect('/admin/agences', 'Erreur (agence utilisée ?)', 'danger');
    }

    /**
     * Liste de tous les trajets
     */
    public function trajets(): void
    {
        $this->requireAdmin();
        $trajets = Trajet::all();
        $this->render('admin/trajets', ['trajets' => $trajets]);
    }
}