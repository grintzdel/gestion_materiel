<?php

use App\Database\DatabaseManager;
use App\Helpers\Template;

class UserController
{
    public function profile()
    {
        if (!$_SESSION['user_info']) {
            header('Location: /connexion');
        }

        Template::renderTemplate('templates/pages/user/profil.php', [
            'user' => $_SESSION['user_info'],
        ]);
    }

    public function connexion()
    {
        if ($_SESSION['user_info']) {
            header('Location: /profil');
        }

        $username = htmlspecialchars(filter_input(INPUT_POST, 'username'));
        $password = htmlspecialchars(filter_input(INPUT_POST, 'password'));

        if (!empty($username) && !empty($password)) {
            $db = DatabaseManager::getInstance();
            $user = $db->select(
                "SELECT * FROM User WHERE username = :username AND password = :password",
                [
                    "username" => $username,
                    "password" => $password,
                ]
            );

            if (!empty($user)) {
                $_SESSION['user_info']['id']        = $user[0]['id'];
                $_SESSION['user_info']['username']  = $user[0]['username'];
                $_SESSION['user_info']['firstname'] = $user[0]['firstname'];
                $_SESSION['user_info']['lastname']  = $user[0]['lastname'];
                $_SESSION['user_info']['role']      = $user[0]['role'];
                $_SESSION['user_info']['clef']      = $user[0]['clef'];

                header('Location: /profil');
            } else {
                $error = "Identifiant ou mot de passe incorrect";
            }
        }

        Template::renderTemplate('templates/pages/user/connection.php', [
            'username' => $username,
            'error'    => $error ?? null,
        ]);
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }
}