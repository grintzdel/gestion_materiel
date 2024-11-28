<?php
ob_start();
?>

<h1>Panel admin</h1>
<ul>
    <li><a href="<?= __SITE_REPOSITORY__ ?>/admin/equipment/add">Ajouter un équipement</a></li>
    <li><a href="<?= __SITE_REPOSITORY__ ?>/admin/equipment/list">Liste des équipements</a></li>
    <li><a href="<?= __SITE_REPOSITORY__ ?>/admin/user/list">Liste des utilisateurs</a></li>
    <li><a href="<?= __SITE_REPOSITORY__ ?>/admin/user/add">Ajouter un utilisateur</a></li>
</ul>


<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>