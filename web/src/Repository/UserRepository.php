<?php

namespace App\Repository;

use App\Database\DatabaseManager;

class UserRepository
{
    public static function getAll()
    {
        $db = DatabaseManager::getInstance();

        $query = "
            SELECT * 
            FROM user
            ";

        return $db->select($query);
    }

    public static function addUser($username, $firstname, $lastname, $email, $role, $password)
    {
        $db = DatabaseManager::getInstance();

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "
            INSERT INTO user (username, firstname, lastname, email, role, password) 
            VALUES (:username, :firstname, :lastname, :email, :role, :password)
            ";

        $db->insert($query, [
            'username'  => $username,
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email,
            'role'      => $role,
            'password'  => $password,
        ]);
    }
}