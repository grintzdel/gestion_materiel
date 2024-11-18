<?php

namespace src\Entity;

use src\Database\DatabaseManager;

class EquipmentEntity
{
    private DatabaseManager $databaseManager;

    public function __construct(
        DatabaseManager $databaseManager
    )
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * @param string $name
     * @param string $description
     * @param int $categoryId
     * @return void
     *
     * Function to add new equipment
     */
    public function addEquipment(
        string $name,
        string $description,
        int    $categoryId
    ): void
    {
        $this->databaseManager->insert(
            request: "INSERT INTO Equipment (name, description, category_id) VALUES (:name, :description, :category_id)",
            param: [
                "name" => $name,
                "description" => $description,
                "category_id" => $categoryId,
            ]
        );
    }

    /**
     * @param int $equipmentId
     * @return array
     *
     * Function to get equipment details
     */
    public function getEquipment(
        int $equipmentId
    ): array
    {
        return $this->databaseManager->select(
            request: "SELECT * FROM Equipment WHERE id = :equipmentId",
            param: [
                "equipmentId" => $equipmentId,
            ]
        );
    }

    /**
     * @param int $equipmentId
     * @param string $name
     * @param string $description
     * @param int $categoryId
     * @return void
     *
     * Function to update equipment details
     */
    public function updateEquipment(
        int    $equipmentId,
        string $name,
        string $description,
        int    $categoryId
    ): void
    {
        $this->databaseManager->insert(
            request: "UPDATE Equipment SET name = :name, description = :description, category_id = :category_id WHERE id = :equipmentId",
            param: [
                "name" => $name,
                "description" => $description,
                "category_id" => $categoryId,
                "equipmentId" => $equipmentId,
            ]
        );
    }

    /**
     * @param int $equipmentId
     * @return void
     *
     * Function to delete equipment
     */
    public function deleteEquipment(
        int $equipmentId
    ): void
    {
        $this->databaseManager->insert(
            request: "DELETE FROM Equipment WHERE id = :equipmentId",
            param: [
                "equipmentId" => $equipmentId,
            ]
        );
    }
}