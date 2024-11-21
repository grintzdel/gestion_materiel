<?php
ob_start();
?>

<h1 class="title">Liste des équipements</h1>
<table>
    <thead>
    <tr>
        <th>Nom</th>
        <th>Quantité</th>
        <th>Clé</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($materials as $material): ?>
        <tr>
            <td><?= $material['name'] ?></td>
            <td><?= $material['available'] ?></td>
            <td><?= $material['require_key'] ? 'Oui' : 'Non' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>