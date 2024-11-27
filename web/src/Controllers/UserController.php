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
            exit;
        }

        $username = htmlspecialchars(filter_input(INPUT_POST, 'username'));
        $password = htmlspecialchars(filter_input(INPUT_POST, 'password'));

        if (!empty($username) && !empty($password)) {
            $db = DatabaseManager::getInstance();
            $user = $db->select(
                "SELECT * FROM user WHERE username = :username",
                [
                    "username" => $username,
                ]
            );

            if (!empty($user)) {
                if (password_verify($password, $user[0]['password'])) {
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

    public function addKey()
    {
        if ($_SESSION['user_info']['clef']) {
            header('Location: /profil');
            exit;
        }

        $key = htmlspecialchars(filter_input(INPUT_POST, 'key'));
        $code = htmlspecialchars(filter_input(INPUT_POST, 'code'));

        if (!empty($key) && !empty($code)) {
            $db = DatabaseManager::getInstance();
            $keyResult = $db->select(
                "SELECT * FROM clef WHERE clef = :clef AND code = :code AND id_user IS NULL",
                [
                    "clef" => $key,
                    "code" => $code,
                ]
            );

            if (!empty($keyResult)) {
                $db->insert(
                    "UPDATE user SET id_clef = :id_clef WHERE id = :id",
                    [
                        "id_clef" => $keyResult[0]['id_clef'],
                        "id"   => $_SESSION['user_info']['id'],
                    ]
                );
                $db->insert(
                    "UPDATE clef SET id_user = :id_user WHERE id_clef = :id_clef",
                    [
                        "id_user" => $_SESSION['user_info']['id'],
                        "id_clef" => $keyResult[0]['id_clef'],
                    ]
                );

                $_SESSION['user_info']['clef'] = $keyResult[0]['clef'];

                header('Location: /profil');
            } else {
                $error = "clef ou code incorrect, ou déja utilisé";
            }
        }

        Template::renderTemplate('templates/pages/user/clef.php', [
            'error' => $error ?? null,
        ]);
    }
}