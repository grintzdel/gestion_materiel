<?php

namespace App\Repository;

use App\Database\DatabaseManager;

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
                    e.require_key,
                    CONCAT('/views/img/', e.image) AS image,
                    GROUP_CONCAT(c.name SEPARATOR ',') as categories
                FROM equipment e
                LEFT JOIN equipement_categorie ec ON ec.id_equipment = e.id_equipment 
                LEFT JOIN categorie c ON c.id_categorie = ec.id_categorie
                WHERE e.id_equipment = :id
                GROUP BY e.id_equipment
            ";

        return $db->select($query, ['id' => $id])[0] ?? null;
    }
}