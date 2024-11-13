<?php

namespace entity;

use \DatabaseManager;

class userEntity
{
    private $databaseManager;
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
     *
     * @return bool|array
     *
     * Function to connect a user after form validation
     */
    public function connect(
        string $username,
        string $password
    ): bool|array
    {
        $user = $this->databaseManager->select(
            request: "SELECT id, password FROM User WHERE username = :username",
            param: [
                "username" => $username,
            ]
        );

        if (!empty($user)) {
            $isGoodPassword = password_verify(
                $password,
                $user[0]["password"]
            );

            if ($isGoodPassword) {
                $dataUser = $this->recoverUserData(
                    userID: $user[0]["id"]
                );

                return $dataUser;
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
            request: "SELECT id, role, username FROM User WHERE id = :userID",
            param: [
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
            password: $oldPassword
        );

        if ($isGoodPassword) {
            $this->databaseManager->insert(
                request: "UPDATE User SET password = :newPassword WHERE id = :userID",
                param: [
                    "newPassword" => password_hash(
                        password: $newPassword,
                        algo: PASSWORD_DEFAULT
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
            password: $password
        );
        if ($isGoodPassword) {
            $this->databaseManager->insert(
                request: "UPDATE User SET username = :newUsername WHERE id = :userID",
                param: [
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
            request: "SELECT password FROM User WHERE id = :userID",
            param: [
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