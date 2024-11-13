<?php

namespace entity;

use \DatabaseManager;

class RentalEntity
{
    private $databaseManager;

    public function __construct(
        DatabaseManager $databaseManager
    )
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * @param int $userId
     * @param int $equipmentId
     * @param string $equipmentName
     * @return void
     *
     * Function to add a new rental
     */
    public function addRental(
        int    $userId,
        int    $equipmentId,
        string $equipmentName
    ): void
    {
        $this->databaseManager->insert(
            request: "INSERT INTO Rental (user_id, equipment_id, equipement_name) VALUES (:user_id, :equipment_id, :equipment_name)",
            param: [
                "user_id" => $userId,
                "equipment_id" => $equipmentId,
                "equipment_name" => $equipmentName,
            ]
        );
    }

    /**
     * @param int $rentalId
     * @return array
     *
     * Function to get rental details
     */
    public function getRental(
        int $rentalId
    ): array
    {
        return $this->databaseManager->select(
            request: "SELECT * FROM Rental WHERE id = :rentalId",
            param: [
                "rentalId" => $rentalId,
            ]
        );
    }

    /**
     * @param int $rentalId
     * @param string $status
     * @return void
     *
     * Function to update rental status
     */
    public function updateRentalStatus(
        int    $rentalId,
        string $status
    ): void
    {
        $this->databaseManager->insert(
            request: "UPDATE Rental SET status = :status WHERE id = :rentalId",
            param: [
                "status" => $status,
                "rentalId" => $rentalId,
            ]
        );
    }

    /**
     * @param int $rentalId
     * @return void
     *
     * Function to delete rental
     */
    public function deleteRental(
        int $rentalId
    ): void
    {
        $this->databaseManager->insert(
            request: "DELETE FROM Rental WHERE id = :rentalId",
            param: [
                "rentalId" => $rentalId,
            ]
        );
    }
}