<?php
namespace App\Models;

use App\Core\Database;
use PDO;

/**
 * Modèle Agence
 */
class Agence
{
    /**
     * Liste toutes les agences
     */
    public static function all(): array
    {
        return Database::getInstance()
            ->query('SELECT * FROM agence ORDER BY nom')
            ->fetchAll();
    }

    /**
     * Trouve une agence par ID
     */
    public static function find(int $id): ?array
    {
        $stmt = Database::getInstance()->prepare('SELECT * FROM agence WHERE id_agence = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Crée une nouvelle agence
     */
    public static function create(string $nom): bool
    {
        $stmt = Database::getInstance()->prepare('INSERT INTO agence (nom) VALUES (?)');
        return $stmt->execute([$nom]);
    }

    /**
     * Met à jour une agence
     */
    public static function update(int $id, string $nom): bool
    {
        $stmt = Database::getInstance()->prepare('UPDATE agence SET nom = ? WHERE id_agence = ?');
        return $stmt->execute([$nom, $id]);
    }

    /**
     * Supprime une agence
     */
    public static function delete(int $id): bool
    {
        $stmt = Database::getInstance()->prepare('DELETE FROM agence WHERE id_agence = ?');
        return $stmt->execute([$id]);
    }
}