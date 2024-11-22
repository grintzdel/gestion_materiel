<?php

use App\Helpers\Template;
use App\Repository\CategorieRepository;
use App\Repository\EquipmentRepository;

class EquipmentController
{
    public function equipmentListAndTemplate()
    {
        $materials = EquipmentRepository::getAll();
        $categories = CategorieRepository::getAllCategorie();

        Template::renderTemplate('templates/pages/equipment/equipmentList.php', [
            'categories' => $categories,
            'materials' => $materials,
        ]);
    }

    public function findEquipment()
    {
        // get the raw data from the request
        header('Content-Type: application/json');
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
        $categories = $data['categories'] ?? [];

        if (empty($categories)) {
            echo json_encode([]);
            return;
        }

        // Nettoyer les catégories
        $categories = array_map('htmlspecialchars', $categories);

        // Appeler le repository pour récupérer les équipements correspondants
        $results = EquipmentRepository::getEquipmentWithCategoriesId($categories);

        // Retourner les résultats sous forme de JSON
        echo json_encode($results);
    }
}