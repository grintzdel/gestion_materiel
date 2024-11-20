<?php
ob_start();
?>

<h1 class="title">Connexion</h1>
<form action="/connexion" method="post">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" value="<?= $username ?>" required>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Mot de passe" required>

    <input class="button" type="submit" name="login" value="Se connecter">
</form>
<?php if (isset($error)): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>