<?php

use PHPUnit\Framework\TestCase;
use App\Models\Agence;

class AgenceTest extends TestCase
{
    private static ?int $agenceId = null;
    private static string $nom;

    public function testCreateAgence(): void
    {
        self::$nom = 'TestVille_' . time();

        $result = Agence::create(self::$nom);
        $this->assertTrue($result);

        // On cherche l'agence qu'on vient de créer par son nom
        $agences = Agence::all();
        $trouvee = null;

        foreach ($agences as $agence) {
            if ($agence['nom'] === self::$nom) {
                $trouvee = $agence;
                break;
            }
        }

        $this->assertNotNull($trouvee, 'Agence non trouvée après création');
        self::$agenceId = $trouvee['id_agence'];
        $this->assertEquals(self::$nom, $trouvee['nom']);
    }

    public function testDeleteAgence(): void
    {
        $this->assertNotNull(self::$agenceId, 'Aucune agence à supprimer');

        $result = Agence::delete(self::$agenceId);
        $this->assertTrue($result);

        // Vérifie qu'elle n'existe plus
        $agence = Agence::find(self::$agenceId);
        $this->assertNull($agence);
    }
}