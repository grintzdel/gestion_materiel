<?php

use src\Database\DatabaseManager;
use src\Entity\UserEntity;

/**
 * @param UserEntity $user
 * @param string $username
 * @param string $password
 * @return void
 *
 * Function to connect a user after form validation and set session.
 */
function connection(
    UserEntity $user,
    string     $username,
    string     $password
): void
{
    $isConnect = $user->connect(
        strtolower($username),
        $password
    );

    if ($isConnect) {
        $_SESSION['user_info'] = $isConnect[0]['id'];
    }
}

/**
 * @param DatabaseManager $database
 * @return array
 *
 * Function to recover all users.
 */
function recoverAllUser(
    DatabaseManager $database
): array
{
    $query = $database->select(
        "SELECT * FROM User"
    );

    $userList = [];

    foreach ($query as $user) {
        $userList[$user['id']] = new UserEntity($database);
        $userList[$user['id']]->recoverUserData($user['id']);
    }

    return $userList;
}
