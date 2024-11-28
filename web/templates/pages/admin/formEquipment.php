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

<h1 class="page-title"><?php echo $isEditing ? 'Modification du matériel' : 'Ajouter du matériel' ;?></h1>
<section class="admin__form">
    <form action="<?php echo $isEditing ? __SITE_REPOSITORY__ . '/admin/equipment/edit?id_equipment='.$id_equipment : __SITE_REPOSITORY__ . '/admin/equipment/add'; ?>" method="post" enctype="multipart/form-data">
        <div class="admin__form__input">
            <label for="name">Nom du matériel</label>
            <input type="text" name="name" id="name" placeholder="Nom du matériel" value="<?= $name ?>" required>
        </div>

        <div class="admin__form__input">
            <label for="description">description</label>
            <textarea name="description" id="description" placeholder="Description du matériel" rows="5" cols="60" required><?= $description ?></textarea>
        </div>

        <div class="admin__form__input">
            <label for="available">Quantité disponible</label>
            <input type="number" name="available" id="available" placeholder="Quantité disponible" value="<?= $available ?>" required>
        </div>

        <div class="admin__form__input">
            <label for="total">Quantité totale</label>
            <input type="number" name="total" id="total" placeholder="Quantité totale" value="<?= $total ?>" required>
        </div>

        <div class="admin__form__input">
            <p>Clé nécessaire ?</p>
            <input type="radio" name="key" id="key-yes" value="yes" <?php if (empty($key) || $key) : ?>checked<?php endif;?>>
            <label for="key-yes">Oui</label>
        </div>
        
        <div class="admin__form__input">
            <input type="radio" name="key" id="key-no" value="no" <?php if (isset($key) && !$key) : ?>checked<?php endif;?>>
            <label for="key-no">Non</label>
        </div>

        <div class="admin__form__input">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/webp">
        </div>

        <div class="admin__form__input">
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
        </div>
        
        <input class="button button--primary" type="submit" name="addEquipment" value="Ajouter le matériel">
    </form>
</section>

<?php if (isset($error)): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>
<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>