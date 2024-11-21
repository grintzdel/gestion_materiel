<?php

use App\Helpers\Template;
use App\Repository\EquipmentRepository;

class EquipmentController
{
    public function equipmentList()
    {
        $materials = EquipmentRepository::getAllWithoutKey();

        Template::renderTemplate('templates/pages/equipment/equipmentList.php', [
            'materials' => $materials,
        ]);
    }
}