<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Trajet;
use App\Models\Agence;


class TrajetController extends Controller
{
    /**
     * Affiche le formulaire de création
     */
    public function createForm(): void
    {
        $this->requireLogin();
        $agences = Agence::all();
        $this->render('trajet/form', [
            'agences' => $agences,
            'trajet'  => null,
            'action'  => '/trajet/create'
        ]);
    }

    /**
     * Traite la création d'un trajet
     */
    public function create(): void
    {
        $this->requireLogin();

        $data = $this->validate($_POST);
        if ($data === false) return;

        $data['id_utilisateur'] = $_SESSION['user']['id'];
        $data['places_dispo']   = $data['places_total'];

        if (Trajet::create($data)) {
            $this->redirect('/', 'Trajet créé avec succès');
        }
        $this->redirect('/trajet/create', 'Erreur lors de la création', 'danger');
    }

    /**
     * Affiche le formulaire de modification
     */
    public function editForm(int $id): void
    {
        $this->requireLogin();
        $trajet = Trajet::find($id);

        // Autorise l'auteur OU l'admin
        if (!$trajet || ($trajet['id_utilisateur'] != $_SESSION['user']['id'] && $_SESSION['user']['role'] !== 'admin')) {
            $this->redirect('/', 'Vous ne pouvez pas modifier ce trajet', 'danger');
        }

        $agences = Agence::all();
        $this->render('trajet/form', [
            'agences' => $agences,
            'trajet'  => $trajet,
            'action'  => "/trajet/edit/$id"
        ]);
    }

    /**
     * Traite la modification d'un trajet
     */
    public function edit(int $id): void
    {
        $this->requireLogin();
        $trajet = Trajet::find($id);

        // Autorise l'auteur OU l'admin
        if (!$trajet || ($trajet['id_utilisateur'] != $_SESSION['user']['id'] && $_SESSION['user']['role'] !== 'admin')) {
            $this->redirect('/', 'Accès refusé', 'danger');
        }

        $data = $this->validate($_POST);
        if ($data === false) return;

        if (Trajet::update($id, $data)) {
            $this->redirect('/', 'Le trajet a été modifié');
        }
        $this->redirect("/trajet/edit/$id", 'Erreur lors de la modification', 'danger');
    }

    /**
     * Supprime un trajet
     */
    public function delete(int $id): void
    {
        $this->requireLogin();
        $trajet = Trajet::find($id);

        // Autorise l'auteur OU l'admin
        if (!$trajet || ($trajet['id_utilisateur'] != $_SESSION['user']['id'] && $_SESSION['user']['role'] !== 'admin')) {
            $this->redirect('/', 'Accès refusé', 'danger');
        }

        if (Trajet::delete($id)) {
            $this->redirect('/', 'Trajet supprimé');
        }
        $this->redirect('/', 'Erreur lors de la suppression', 'danger');
    }

    /**
     * Validation des données du formulaire
     */
    private function validate(array $post): array|false
    {
        $depart    = (int)($post['id_agence_depart'] ?? 0);
        $arrivee   = (int)($post['id_agence_arrivee'] ?? 0);
        $dhDepart  = $post['date_heure_depart'] ?? '';
        $dhArrivee = $post['date_heure_arrivee'] ?? '';
        $places    = (int)($post['places_total'] ?? 0);

        if ($depart === $arrivee) {
            $this->redirect($_SERVER['HTTP_REFERER'] ?? '/', 'Agences de départ et d\'arrivée identiques', 'danger');
            return false;
        }
        if (strtotime($dhArrivee) <= strtotime($dhDepart)) {
            $this->redirect($_SERVER['HTTP_REFERER'] ?? '/', 'La date d\'arrivée doit être après le départ', 'danger');
            return false;
        }
        if ($places < 1) {
            $this->redirect($_SERVER['HTTP_REFERER'] ?? '/', 'Nombre de places invalide', 'danger');
            return false;
        }

        return [
            'id_agence_depart'   => $depart,
            'id_agence_arrivee'  => $arrivee,
            'date_heure_depart'  => $dhDepart,
            'date_heure_arrivee' => $dhArrivee,
            'places_total'       => $places,
            'places_dispo'       => $places
        ];
    }
}