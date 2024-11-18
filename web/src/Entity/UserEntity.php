<?php

namespace src\Entity;

use src\Database\DatabaseManager;

class UserEntity
{
    private DatabaseManager $databaseManager;
    public ?array $loggedInUser = null;

    public function __construct(
        DatabaseManager $databaseManager
    )
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     *
     * Function to connect a user after form validation
     */
    /*
     * TODO : Add password hash verification
     */
    public function connect(
        string $username,
        string $password
    ): bool
    {
        $user = $this->databaseManager->select(
            "SELECT id, password FROM User WHERE username = :username",
            [
                "username" => $username,
            ]
        );

        if (!empty($user)) {
            /* $isGoodPassword = password_verify(
                $password,
                $user[0]["password"]
            ); */

            $isGoodPassword = $password === $user[0]["password"];

            if ($isGoodPassword) {
                $this->loggedInUser = $this->recoverUserData(
                    $user[0]["id"]
                );

                return true;
            }
        }
        return false;
    }

    /**
     * @param int $userID
     * @return array
     *
     * Function to recover user data
     */
    public function recoverUserData(
        int $userID
    ): array
    {
        $user = $this->databaseManager->select(
            "SELECT id, role, username FROM User WHERE id = :userID",
            [
                "userID" => $userID,
            ]
        );

        $this->loggedInUser = $user;
        return $this->loggedInUser;
    }

    /**
     * @param string $newPassword
     * @param string $oldPassword
     * @return bool
     *
     * Function to update user password
     */
    public function updatePassword(
        string $newPassword,
        string $oldPassword
    ): bool
    {
        $isGoodPassword = $this->passwordCheck(
            $oldPassword
        );

        if ($isGoodPassword) {
            $this->databaseManager->insert(
                "UPDATE User SET password = :newPassword WHERE id = :userID",
                [
                    "newPassword" => password_hash(
                        $newPassword,
                        PASSWORD_DEFAULT
                    ),
                    "userID" => $this->loggedInUser[0]['id'],
                ]
            );
            return true;
        }
        return false;
    }

    /**
     * @param string $newUsername
     * @param string $password
     * @return bool
     *
     * Function to update user username
     */
    public function updateUsername(
        string $newUsername,
        string $password
    ): bool
    {
        $isGoodPassword = $this->passwordCheck(
            $password
        );
        if ($isGoodPassword) {
            $this->databaseManager->insert(
                "UPDATE User SET username = :newUsername WHERE id = :userID",
                [
                    "newUsername" => $newUsername,
                    "userID" => $this->loggedInUser[0]['id'],
                ]
            );
            return true;
        }
        return false;
    }

    /**
     * @param string $password
     * @return bool
     *
     * Private function to check user password before update account information
     */
    private function passwordCheck(
        string $password
    ): bool
    {
        $user = $this->databaseManager->select(
            "SELECT password FROM User WHERE id = :userID",
            [
                "userID" => $this->loggedInUser[0]['id'],
            ]
        );

        $isGoodPassword = password_verify(
            $password,
            $user[0]["password"]
        );
        return $isGoodPassword;
    }
}