<?php
ob_start();
/**
 * @var array $user Session user data : id, email, username, firstname, lastname, role, id_clef
 */
?>

<section class="profile">
    <h1 class="page-title">Hello <?= $user['firstname'] ?> (<?= $user['username'] ?>) 👋</h1>
    <h2 class="profile__title">Informations personnelles</h2>
        <form class="profile__user" action="">
            <div class="profile__user__infos">
                <div class=profile__user__infos__text>
                    <p>Mail : </p><p class="profile__user__infos__text__value"><?= $user['email'] ?></p>
                </div>
                <input type="text" name="email" id="email" placeholder="Modifier ton mail">
            </div>
            <div class="profile__user__infos">
                <div class=profile__user__infos__text>
                    <p>Mot de passe : </p>
                </div>
                <input type="password" name="password" id="password" placeholder="Modifier ton mot de passe">
            </div>
            <div class="profile__user__infos">
                <div class=profile__user__infos__text>
                    <p>Nom d'utilisateur : </p><p class="profile__user__infos__text__value"><?= $user['username'] ?></p>
                </div>
            </div>
            <div class="profile__user__infos">
                <div class=profile__user__infos__text>
                    <p>Clef : </p><p class="profile__user__infos__text__value"><?php if ($user['id_clef']) : ?> <?= $user['id_clef'] ?> <?php else : ?> Pas de clef, chèque manquant <?php endif; ?></p>
                </div>
            </div>
            <input class="button button--primary" type="submit" name="edit" value="Modifier">
            <a class="button button--secondary" href="<?= __SITE_REPOSITORY__ ?>/deconnexion">Déconnexion</a>
        </form>
</section>
<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>