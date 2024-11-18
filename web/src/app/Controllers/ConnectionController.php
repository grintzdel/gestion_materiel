<?php

declare(strict_types=1);

use entity\UserEntity;

class ConnectionController
{
    public function connection()
    {
        //require_once 'src/templates/pages/connection.php';


        $isError = false;

        if (isset($_SESSION['user_info'])) {
            redirectPage();
        } else {
            connection(
                $user,
                $_POST['username'],
                $_POST['password']
            );

            if (!$user->loggedInUser) {
                $isError = true;
            } else {
                redirectPage();
            }
        }
    }

}