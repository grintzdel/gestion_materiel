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
            $results = EquipmentRepository::getAll();
        } else {
            // Nettoyer les catégories
            $categories = array_map('htmlspecialchars', $categories);

            // Appeler le repository pour récupérer les équipements correspondants
            $results = EquipmentRepository::getEquipmentWithCategoriesId($categories);
        }


        switch ($data['availability']) {
            case 'true':
                $results = array_filter($results, function ($equipment) {
                    return $equipment['available'] >= 1;
                });
                break;
            case 'false':
                $results = array_filter($results, function ($equipment) {
                    return $equipment['available'] == 0;
                });
                break;
            default:
                break;
        }

        // Retourner les résultats sous forme de JSON
        echo json_encode(array_values($results));
    }
}