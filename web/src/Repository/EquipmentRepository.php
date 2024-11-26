<?php

namespace App\Repository;

use App\Database\DatabaseManager;
use Exception;

class EquipmentRepository
{
    /**
     * @param int $limit
     *
     * @return array
     */
    public static function getAll(int $limit = 50): array
    {
        $db = DatabaseManager::getInstance();

        $limit = max(1, intval($limit));

        $query = "
                SELECT 
                    e.id_equipment,
                    e.name,
                    e.description,
                    e.available,
                    e.total,
                    e.require_key,
                    CONCAT('/views/img/', e.image) AS image,
                    GROUP_CONCAT(c.name SEPARATOR ',') AS categories
                FROM equipment e 
                LEFT JOIN equipement_categorie ec ON ec.id_equipment = e.id_equipment 
                LEFT JOIN categorie c ON c.id_categorie = ec.id_categorie
                GROUP BY e.id_equipment
                LIMIT $limit
            ";
        return $db->select($query);
    }

    public static function getEquipmentWithCategoriesId($categories, $limit = 50): array
    {
        $db = DatabaseManager::getInstance();

        $categories = implode(',', $categories);
        $limit = max(1, intval($limit));

        $query = "
                SELECT 
                    e.id_equipment,
                    e.name,
                    e.description,
                    e.available,
                    e.total,
                    e.require_key,
                    CONCAT('/views/img/', e.image) AS image,
                    GROUP_CONCAT(c.name SEPARATOR ',') as categories
                FROM equipment e
                LEFT JOIN equipement_categorie ec ON ec.id_equipment = e.id_equipment 
                LEFT JOIN categorie c ON c.id_categorie = ec.id_categorie
                WHERE c.id_categorie IN ($categories)
                GROUP BY e.id_equipment
                LIMIT $limit
            ";

        return $db->select($query);
    }

    public static function getOne($id)
    {
        $db = DatabaseManager::getInstance();

        $id = max(1, intval($id));

        $query = "
                SELECT 
                    e.id_equipment,
                    e.name,
                    e.description,
                    e.available,
                    e.total,
                    e.require_key,
                    CONCAT('/views/img/', e.image) AS image,
                    GROUP_CONCAT(c.name SEPARATOR ',') as categories,
                    GROUP_CONCAT(ec.id_categorie SEPARATOR ',') as id_categories
                FROM equipment e
                LEFT JOIN equipement_categorie ec ON ec.id_equipment = e.id_equipment 
                LEFT JOIN categorie c ON c.id_categorie = ec.id_categorie
                WHERE e.id_equipment = :id
                GROUP BY e.id_equipment
            ";

        return $db->select($query, ['id' => $id])[0] ?? null;
    }

    /**
     * @param int $id
     * @return void
     */
    public static function deleteById(int $id): void
    {
        $db = DatabaseManager::getInstance();

        $id = max(1, intval($id));

        $db->insert(
            "DELETE FROM equipment WHERE id_equipment = :id",
            ['id' => $id]
        );
        $db->insert(
            "DELETE FROM equipement_categorie WHERE id_equipment = :id",
            ['id' => $id]
        );
    }

    /**
     * @param $id_equipment
     * @param $quantity
     * @param $start_date
     * @param $end_date
     * @param $id_user
     *
     * @return void
     *
     * @throws Exception
     */
    public static function addPannier($id_user, $id_equipment, $quantity, $start_date, $end_date)
    {
        try {
            $db = DatabaseManager::getInstance();

            $id_user = max(1, intval($id_user));
            $id_equipment = max(1, intval($id_equipment));
            $quantity = max(1, intval($quantity));

            $db->insert(
                "INSERT INTO cart (id_user, id_equipment, quantity, start, end) VALUES (:id_user, :id_equipment, :quantity, :start, :end)",
                [
                    'id_user'      => $id_user,
                    'id_equipment' => $id_equipment,
                    'quantity'     => $quantity,
                    'start'        => $start_date,
                    'end'          => $end_date,
                ]
            );
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de l'équipement au panier : " . $e->getMessage());
        }
    }
}