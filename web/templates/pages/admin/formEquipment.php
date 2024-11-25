<?php
ob_start();
/**
 * @var int    $id_equipment     Id of the equipment
 * @var string $name             Name write in the form
 * @var string $description      Description write in the form
 * @var bool   $key              Key write in the form
 * @var array  $categoriesSelect List of categories selected
 * @var int    $available        Available write in the form
 * @var int    $total            Total write in the form
 * @var bool   $isEditing        Form is in editing mode
 * @var array  $categories       List of categories : id, name
 * @var string $error            Error message if the username or password is incorrect
 */
?>

<h1 class="title"><?php echo $isEditing ? 'Modification du matériel' : 'Ajouter du matériel' ;?></h1>
<form action="<?php echo $isEditing ? '/admin/equipment/edit?id_equipment='.$id_equipment : '/admin/equipment/add'; ?>" method="post" enctype="multipart/form-data">
    <label for="name">Nom du matériel</label>
    <input type="text" name="name" id="name" placeholder="Nom du matériel" value="<?= $name ?>" required>
    <br>

    <label for="description">description</label>
    <textarea name="description" id="description" placeholder="Description du matériel" rows="5" cols="60" required><?= $description ?></textarea>
    <br>

    <label for="available">Quantité disponible</label>
    <input type="number" name="available" id="available" placeholder="Quantité disponible" value="<?= $available ?>" required>
    <br>
    <label for="total">Quantité totale</label>
    <input type="number" name="total" id="total" placeholder="Quantité totale" value="<?= $total ?>" required>
    <br>

    <p>Clé nécessaire ?</p>
    <input type="radio" name="key" id="key-yes" value="yes" <?php if (empty($key) || $key) : ?>checked<?php endif;?>>
    <label for="key-yes">Oui</label>
    <br>
    <input type="radio" name="key" id="key-no" value="no" <?php if (isset($key) && !$key) : ?>checked<?php endif;?>>
    <label for="key-no">Non</label>
    <br>

    <label for="image">Image</label>
    <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/webp">
    <br>

    <p>Catérories : </p>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li>
                <input
                    type="checkbox"
                    id="category-<?= $category['id_categorie'] ?>"
                    name="category[]"
                    value="<?= $category['id_categorie'] ?>"
                    <?php if (in_array($category['id_categorie'], $categoriesSelect) ): ?>checked<?php endif; ?>
                />
                <label for="category-<?= $category['id_categorie'] ?>"><?= $category['name'] ?></label>
            </li>
        <?php endforeach; ?>
    </ul>

    <input class="button" type="submit" name="addEquipment" value="Ajouter le matériel">
</form>
<?php if (isset($error)): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>
<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>