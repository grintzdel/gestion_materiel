<?php
ob_start();
/**
 * @var array $equipment Equipment data : id, name, description, available, require_key, categories(merged with ',')
 */
?>
<h1 class="title">Voila l'équipement</h1>
<h2>Les infos</h2>
<?php foreach ($equipment as $key => $value): ?>
    <p><?= $key ?> : <?= $value ?></p>
<?php endforeach; ?>

<br><br>
<h2>Réserver</h2>
<form action="/equipment/addPannier" method="post">
    <input type="hidden" name="id" value="<?= $equipment['id'] ?>">
    <label> Quantité :
        <input type="number" name="quantity" value="1" max="<?= $equipment['available'] ?>">
    </label>
    <br>
    <label> Date de début :
        <input type="date" name="start_date">
    </label>
    <br>
    <label> Date de fin :
        <input type="date" name="end_date">
    </label>
    <br>
    <button type="submit">Ajouter au pannier</button>
</form>
<p><?= $error ?? '' ?></p>


<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>