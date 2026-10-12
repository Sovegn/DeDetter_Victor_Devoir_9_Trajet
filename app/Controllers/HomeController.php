<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Trajet;

/**
 * Contrôleur de la page d'accueil
 */
class HomeController extends Controller
{
    /**
     * Affiche la liste des trajets disponibles
     */
    public function index(): void
    {
        $trajets = Trajet::available();
        $this->render('home/index', ['trajets' => $trajets]);
    }
}