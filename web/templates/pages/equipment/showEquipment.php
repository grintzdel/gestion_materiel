<?php
ob_start();
/**
 * @var array $equipment Equipment data : id, name, description, available, require_key, categories(merged with ',')
 */
?>
<h1 class="title">Voila l'équipement</h1>
<?php foreach ($equipment as $key => $value): ?>
    <p><?= $key ?> : <?= $value ?></p>
<?php endforeach; ?>


<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>