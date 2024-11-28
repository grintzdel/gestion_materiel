<?php
ob_start();
/**
 * @var array $users
 */
?>

<h1 class="page-title">Liste des utilisateurs du site</h1>
<section class="admin__user-list">
    <?php if (empty($users)): ?>
        <p>Aucun utilisateur n'a été trouvé</p>
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Role</th>
                <th>A une clé</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['firstname'] ?></td>
                    <td><?= $user['lastname'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['id_clef'] ? 'Oui' : 'Non' ?></td>
                    <td>
                        <a href="<?= __SITE_REPOSITORY__ ?>/admin/user/delete?id=<?= $user['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <br>
    <a href="<?= __SITE_REPOSITORY__ ?>/admin/user/add">Ajouter un utilisateur</a>
</section>



<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>