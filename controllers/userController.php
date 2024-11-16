<?php

use entity\UserEntity;

/**
 * @param UserEntity $user
 * @param string $mail
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
        username: strtolower($username),
        password: $password
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
        request: "SELECT * FROM User"
    );

    $userList = [];

    foreach ($query as $user) {
        $userList[$user['id']] = new UserEntity(databaseManager: $database);
        $userList[$user['id']]->recoverUserData(userID: $user['id']);
    }

    return $userList;
}
