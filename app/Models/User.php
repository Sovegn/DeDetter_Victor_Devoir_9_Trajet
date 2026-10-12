<?php
namespace App\Models;

use App\Core\Database;
use PDO;

/**
 * Modèle Utilisateur
 */
class User
{
    /**
     * Trouve un utilisateur par email
     */
    public static function findByEmail(string $email): ?array
    {
        $stmt = Database::getInstance()->prepare('SELECT * FROM utilisateur WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    /**
     * Trouve un utilisateur par ID
     */
    public static function find(int $id): ?array
    {
        $stmt = Database::getInstance()->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    /**
     * Liste tous les utilisateurs
     */
    public static function all(): array
    {
        return Database::getInstance()
            ->query('SELECT id_utilisateur, nom, prenom, email, telephone, role FROM utilisateur ORDER BY nom')
            ->fetchAll();
    }
}