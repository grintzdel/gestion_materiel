<?php
ob_start();
?>

<h1 class="title">Voila test info mon reuf</h1>
<?php foreach ($user as $key => $value): ?>
    <p><?= $key ?> : <?= $value ?></p>
<?php endforeach; ?>

<a href="/deconnexion">Déconnexion</a>
<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>