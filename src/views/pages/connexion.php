<?php
session_start();

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use entity\UserEntity;

$isError = false;

function redirectPage(): void
{
    header("Location: profil.php");
    exit();
}

/* Function For Link Between Controller And Entity */
function loginBtn(UserEntity $user): void
{
    global $isError;

    if (isset($_SESSION['user_info'])) {
        redirectPage();
    } else {
        connection(
            user: $user,
            username: $_POST['username'],
            password: $_POST['password']
        );

        if (!$user->loggedInUser) {
            $isError = true;
        } else {
            redirectPage();
        }
    }
}

/* Condition For Login */
if (isset($_POST['username']) && isset($_POST['password'])) {
    require_once '../../../database/DatabaseManager.php';
    require_once '../../../controllers/userController.php';
    require_once '../../../entities/UserEntity.php';

    $database = DatabaseManager::getInstance();
    $user = new UserEntity($database);

    if (isset($_POST['login'])) {
        loginBtn($user);
    }
}

if (isset($_SESSION['user_info'])) {
    redirectPage();
}
?>

<main>
    <h1 class="title">Connexion</h1>
    <form action="connexion.php" method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>

        <input class="button" type="submit" name="login" value="Se connecter">
    </form>

    <?php
    if ($isError) {
        echo "<p>Identifiants ou mot de passe incorrect</p>";
    }
    ?>
</main>