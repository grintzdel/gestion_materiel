<!DOCTYPE html>
<html lang="fr">
<?php require_once 'templates/partials/head.php'; ?>
<body>
<?php require_once 'templates/partials/header.php'; ?>
<main>
<section class="auth">
    <div class="auth__container">
        <div class="auth__img">
            <img src="/views/img/form__img.png" alt="IUT Chambéry">
        </div>
        <div class="auth__form">
            <h1 class="auth__form__title">Content de te revoir !</h1>
            <form action="/connexion" method="post">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" placeholder="Entre ton nom d'utilisateur" value="<?= $username ?>" required>

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Entre ton mot de passe" required>

                <input class="button button--primary" type="submit" name="login" value="Se connecter">
            </form>
        </div>
    </div>
</section>

<?php if (isset($error)): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<?php require_once 'templates/partials/footer.php'; ?>
</body>
</html>