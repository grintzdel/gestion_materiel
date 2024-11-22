<?php

namespace App\Repository;

use App\Database\DatabaseManager;

class CategorieRepository
{
    public static function getAllCategorie()
    {
        $db = DatabaseManager::getInstance();
        $query = "SELECT * FROM categorie";
        return $db->select($query);
    }
}











