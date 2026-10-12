<?php

use PHPUnit\Framework\TestCase;
use App\Models\Trajet;
use App\Models\Agence;
use App\Core\Database;

class TrajetTest extends TestCase
{
    private static int $trajetId;
    private static int $agenceDepartId;
    private static int $agenceArriveeId;

    public static function setUpBeforeClass(): void
    {
        // On récupère deux agences existantes
        $agences = Agence::all();
        self::$agenceDepartId = $agences[0]['id_agence'];
        self::$agenceArriveeId = $agences[1]['id_agence'];
    }

    public function testCreateTrajet(): void
    {
        $data = [
            'id_utilisateur'     => 1,
            'id_agence_depart'   => self::$agenceDepartId,
            'id_agence_arrivee'  => self::$agenceArriveeId,
            'date_heure_depart'  => '2026-12-01 08:00:00',
            'date_heure_arrivee' => '2026-12-01 12:00:00',
            'places_total'       => 4,
            'places_dispo'       => 4
        ];

        $result = Trajet::create($data);
        $this->assertTrue($result);

        // On récupère le dernier trajet créé pour les tests suivants
        $trajets = Trajet::all();
        self::$trajetId = $trajets[0]['id_trajet'];
    }

    public function testUpdateTrajet(): void
    {
        $data = [
            'id_agence_depart'   => self::$agenceDepartId,
            'id_agence_arrivee'  => self::$agenceArriveeId,
            'date_heure_depart'  => '2026-12-02 09:00:00',
            'date_heure_arrivee' => '2026-12-02 13:00:00',
            'places_total'       => 3,
            'places_dispo'       => 3
        ];

        $result = Trajet::update(self::$trajetId, $data);
        $this->assertTrue($result);

        $trajet = Trajet::find(self::$trajetId);
        $this->assertEquals(3, $trajet['places_total']);
    }

    public function testDeleteTrajet(): void
    {
        $result = Trajet::delete(self::$trajetId);
        $this->assertTrue($result);

        $trajet = Trajet::find(self::$trajetId);
        $this->assertNull($trajet);
    }
}