<?php

namespace App\Validator;

use App\Database\DatabaseManager;
use Exception;

class Equipment
{
    /**
     * @param bool $isEditing
     * @param array $data
     *
     * @throws Exception
     */
    public static function validate(bool $isEditing, array $data): void
    {
        if (strlen($data['name']) > 255) {
            throw new Exception("Le nom de l'équipement est trop long");
        }
        if ($data['image']['size'] > 10 * 1024 * 1024) {
            throw new Exception("L'image est trop lourde ! (10Mo max)");
        }
        if ($data['available'] > $data['total']) {
            throw new Exception("Le nombre d'équipement disponible ne peut pas être supérieur au nombre total d'équipement");
        }
        if (!$isEditing && empty($data['image'])) {
            throw new Exception("Veuillez ajouter une image");
        }
    }

    /**
     * @param bool $isEditing
     * @param array $data
     *
     * @return bool
     *
     * @throws Exception
     */
    public static function insert(bool $isEditing, array $data): bool
    {
        $db = DatabaseManager::getInstance();

        $key = $data['key'] === 'yes' ? 1 : 0;

        // Insertion equipment
        if ($isEditing) {
            $db->insert(
                "UPDATE equipment SET name = :name, description = :description, available = :available, total = :total, require_key = :key WHERE id_equipment = :id_equipment",
                [
                    "name" => $data['name'],
                    "description" => $data['description'],
                    "available" => $data['available'],
                    "total" => $data['total'],
                    "key" => $key,
                    "id_equipment" => $data['id_equipment'],
                ]
            );
        } else {
            $db->insert(
                "INSERT INTO equipment (name, description, available, total, require_key) VALUES (:name, :description, :available, :total, :key)",
                [
                    "name" => $data['name'],
                    "description" => $data['description'],
                    "available" => $data['available'],
                    "total" => $data['total'],
                    "key" => $key,
                ]
            );
        }
        $id_equipment = !$isEditing ? $db->lastInsertId() : $data['id_equipment'];

        // Upload image (si nécessaire)
        if (!$isEditing || $data['image']['size'] > 0) {
            $path = __DIR__ . '/../../views/img/';
            $extension = strtolower(pathinfo($data['image']['name'], PATHINFO_EXTENSION));

            if (!move_uploaded_file($data['image']['tmp_name'], $path . $id_equipment . '.' . $extension)) {
                throw new Exception("Erreur lors de l'upload de l'image");
            }

            $db->insert(
                "UPDATE equipment SET image = :image WHERE id_equipment = :id_equipment",
                [
                    "image" => $id_equipment . '.' . $extension,
                    "id_equipment" => $id_equipment,
                ]
            );
        }

        // Insertion categories
        if ($data['categoriesSelect']) {
            foreach ($data['categoriesSelect'] as $categorie) {
                $db->insert(
                    "INSERT INTO equipement_categorie (id_equipment, id_categorie) VALUES (:id_equipment, :id_categorie)",
                    [
                        "id_equipment" => $id_equipment,
                        "id_categorie" => $categorie,
                    ]
                );
            }
        }

        return true;
    }

    /**
     * @param bool $isEditing
     * @param array $data
     *
     * @return bool
     *
     * @throws Exception
     */
    public static function form(bool $isEditing, array $data): bool
    {
        try {
            self::validate($isEditing, $data);

            self::insert($isEditing, $data);

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}