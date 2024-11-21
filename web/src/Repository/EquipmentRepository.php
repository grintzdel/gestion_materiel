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
    public static function getAllWithoutKey(int $limit = 50): array
    {
        $db = DatabaseManager::getInstance();

        $limit = max(1, intval($limit));

        $query = "SELECT * FROM equipment WHERE require_key = 0 LIMIT $limit";
        return $db->select($query);
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public static function getAll(int $limit = 50): array
    {
        $db = DatabaseManager::getInstance();

        $limit = max(1, intval($limit));

        $query = "SELECT * FROM equipment LIMIT $limit";
        return $db->select($query);
    }
}