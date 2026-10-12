<?php
namespace App\Core;

use PDO;
use PDOException;

/**
 * Classe de connexion singleton à la base de données
 */
class Database
{
    private static ?PDO $instance = null;

    /**
     * Retourne l'instance PDO
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';
            try {
                self::$instance = new PDO(
                    "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}",
                    $config['user'],
                    $config['password'],
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die('Erreur de connexion BDD : ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}