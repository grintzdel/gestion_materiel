<?php
ob_start();
?>

<section class="admin"> 

<h1 class="page-title">Panel admin</h1>
<div class="admin__pannel">
    <a class="button button--primary" href="<?= __SITE_REPOSITORY__ ?>/admin/equipment/add">Ajouter un équipement</a></li>
    <a class="button button--primary" href="<?= __SITE_REPOSITORY__ ?>/admin/equipment/list">Liste des équipements</a></li>
    <a class="button button--primary" href="<?= __SITE_REPOSITORY__ ?>/admin/user/list">Liste des utilisateurs</a></li>
    <a class="button button--primary" href="<?= __SITE_REPOSITORY__ ?>/admin/user/add">Ajouter un utilisateur</a></li>
</ul>
</div>
   

</section>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>