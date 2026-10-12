<?php
namespace App\Models;

use App\Core\Database;
use PDO;

/**
 * Modèle Trajet
 */
class Trajet
{
    /**
     * Liste des trajets futurs avec places disponibles
     */
    public static function available(): array
    {
        $sql = "SELECT t.*, 
                       ad.nom AS agence_depart, 
                       aa.nom AS agence_arrivee,
                       u.nom AS auteur_nom, u.prenom AS auteur_prenom,
                       u.telephone AS auteur_tel, u.email AS auteur_email
                FROM trajet t
                JOIN agence ad ON t.id_agence_depart = ad.id_agence
                JOIN agence aa ON t.id_agence_arrivee = aa.id_agence
                JOIN utilisateur u ON t.id_utilisateur = u.id_utilisateur
                WHERE t.places_dispo > 0 
                  AND t.date_heure_depart > NOW()
                ORDER BY t.date_heure_depart ASC";
        return Database::getInstance()->query($sql)->fetchAll();
    }

    /**
     * Trouve un trajet par ID
     */
    public static function find(int $id): ?array
    {
        $sql = "SELECT t.*, 
                       ad.nom AS agence_depart, 
                       aa.nom AS agence_arrivee,
                       u.nom AS auteur_nom, u.prenom AS auteur_prenom,
                       u.telephone AS auteur_tel, u.email AS auteur_email
                FROM trajet t
                JOIN agence ad ON t.id_agence_depart = ad.id_agence
                JOIN agence aa ON t.id_agence_arrivee = aa.id_agence
                JOIN utilisateur u ON t.id_utilisateur = u.id_utilisateur
                WHERE t.id_trajet = ?";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Liste tous les trajets (admin)
     */
    public static function all(): array
    {
        $sql = "SELECT t.*, ad.nom AS agence_depart, aa.nom AS agence_arrivee,
                       u.nom AS auteur_nom, u.prenom AS auteur_prenom
                FROM trajet t
                JOIN agence ad ON t.id_agence_depart = ad.id_agence
                JOIN agence aa ON t.id_agence_arrivee = aa.id_agence
                JOIN utilisateur u ON t.id_utilisateur = u.id_utilisateur
                ORDER BY t.date_heure_depart DESC";
        return Database::getInstance()->query($sql)->fetchAll();
    }

    /**
     * Crée un trajet
     */
    public static function create(array $data): bool
    {
        $sql = "INSERT INTO trajet 
                (id_utilisateur, id_agence_depart, id_agence_arrivee, 
                 date_heure_depart, date_heure_arrivee, places_total, places_dispo)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = Database::getInstance()->prepare($sql);
        return $stmt->execute([
            $data['id_utilisateur'],
            $data['id_agence_depart'],
            $data['id_agence_arrivee'],
            $data['date_heure_depart'],
            $data['date_heure_arrivee'],
            $data['places_total'],
            $data['places_dispo']
        ]);
    }

    /**
     * Met à jour un trajet
     */
    public static function update(int $id, array $data): bool
    {
        $sql = "UPDATE trajet SET 
                id_agence_depart = ?, id_agence_arrivee = ?,
                date_heure_depart = ?, date_heure_arrivee = ?,
                places_total = ?, places_dispo = ?
                WHERE id_trajet = ?";
        $stmt = Database::getInstance()->prepare($sql);
        return $stmt->execute([
            $data['id_agence_depart'],
            $data['id_agence_arrivee'],
            $data['date_heure_depart'],
            $data['date_heure_arrivee'],
            $data['places_total'],
            $data['places_dispo'],
            $id
        ]);
    }

    /**
     * Supprime un trajet
     */
    public static function delete(int $id): bool
    {
        $stmt = Database::getInstance()->prepare('DELETE FROM trajet WHERE id_trajet = ?');
        return $stmt->execute([$id]);
    }
}