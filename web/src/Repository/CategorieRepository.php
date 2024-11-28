<?php

namespace App\Repository;

use App\Database\DatabaseManager;

class CategorieRepository
{
    public static function getAllCategorie()
    {
        $db = DatabaseManager::getInstance();
        $query = "
            SELECT 
                c.id_categorie, 
                c.name, 
                COUNT(e.id_equipment) as available
            FROM categorie c
            LEFT JOIN equipement_categorie ec ON c.id_categorie = ec.id_categorie
            LEFT JOIN equipment e ON ec.id_equipment = e.id_equipment
            GROUP BY c.id_categorie
            ";
        return $db->select($query);
    }
}











