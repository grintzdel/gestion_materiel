<?php

use App\Database\DatabaseManager;
use App\Helpers\Template;
use App\Repository\CategorieRepository;

class AdminController
{
    public function addEquipment()
    {
        if (!$_SESSION['user_info']) {
            header('Location: /connexion');
        }
        if ($_SESSION['user_info']['role'] !== 'admin') {
            header('Location: /profil');
        }
        $error = null;

        $name             = htmlspecialchars(filter_input(INPUT_POST, 'name'));
        $description      = htmlspecialchars(filter_input(INPUT_POST, 'description'));
        $key              = htmlspecialchars(filter_input(INPUT_POST, 'key'));
        $image            = $_FILES['image'] ?? null;
        $categoriesSelect = $_POST['category'] ?? null;

        if (!empty($name) && !empty($description) && !empty($key)) {
            if (strlen($name) > 255) {
                $error = "Le nom de l'équipement est trop long";
            }
            $key = $key === 'yes' ? 1 : 0;
            if ($image['size'] > 10*1024*1024) {
                $error = "L'image est trop lourde ! (10Mo max)";
            }


            if (empty($error)) {
                try {
                    // Insertion equipment
                    $db = DatabaseManager::getInstance();
                    $db->insert(
                        "INSERT INTO equipment (name, description, available, require_key) VALUES (:name, :description, :available, :key)",
                        [
                            "name" => $name,
                            "description" => $description,
                            "available" => 0,
                            "key" => $key,
                        ]
                    );
                    $id_equipment = $db->lastInsertId();
                    $path = __DIR__ . '/../../views/img/';
                    $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));


                    // Upload image
                    if (!move_uploaded_file($image['tmp_name'], $path . $id_equipment . '.' . $extension)) {
                        throw new Exception("Erreur lors de l'upload de l'image");
                    }

                    // Insertion image
                    $db->insert(
                        "UPDATE equipment SET image = :image WHERE id_equipment = :id_equipment",
                        [
                            "image"   => $id_equipment . '.' . $extension,
                            "id_equipment" => $id_equipment,
                        ]
                    );

                    // Insertion categories
                    if ($categoriesSelect) {
                        foreach ($categoriesSelect as $categorie) {
                            $db->insert(
                                "INSERT INTO equipement_categorie (id_equipment, id_categorie) VALUES (:id_equipment, :id_categorie)",
                                [
                                    "id_equipment" => $id_equipment,
                                    "id_categorie" => $categorie,
                                ]
                            );
                        }
                    }


                header('Location: /equipment');
                } catch (Exception $e) {
                    $error = "Erreur lors de l'ajout de l'équipement";
                }
            }
        }

        $categories = CategorieRepository::getAllCategorie();

        Template::renderTemplate('templates/pages/admin/addEquipment.php', [
            'name'             => $name,
            'description'      => $description,
            'key'              => $key,

            'categories'       => $categories,
            'error'            => $error ?? null,
        ]);
    }
}
