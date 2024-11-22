<?php
ob_start();
?>
<script src="/scripts/ajax/equipment/filter.js"></script>
<?php
$link = ob_get_clean();


ob_start();
/**
 * @var array $categories List of categories : id, name
 * @var array $materials  List of materials  : id, name, description, available, require_key, categories(merged with ',')
 */
?>

<h1 class="page-title">Equipement</h1>
<section class="archive">
    <div class="archive__filters">
        
        <!-- Filter 1 : Catégories -->
        <details class="filter">
            <summary class="filter__header">
                <h3 class="filter__header__title">Catégories</h3>
                <img src="/views/svg/open-close--black.svg" alt="Afficher les catégories" class="filter__header__icon">
            </summary>
            <div class="filter__content">
                <ul class="filter__list">
                    <?php foreach ($categories as $category): ?>
                        <li class="filter__list__item">
                            <input type="checkbox" id="category-<?= $category['id_categorie'] ?>" name="category-<?= $category['id_categorie'] ?>">
                            <label for="category-<?= $category['id_categorie'] ?>"><?= $category['name'] ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </details>

        <!-- Filter 2 : Disponibilités -->
        <details class="filter">
            <summary class="filter__header">
                <h3 class="filter__header__title">Disponibilités</h3>
                <img src="/views/svg/open-close--black.svg" alt="Afficher les disponibilités" class="filter__header__icon">
            </summary>
            <div class="filter__content">
                <ul class="filter__list">
                    <!-- TODO: Add checkbox here -->
                </ul>
            </div>
        </details>
    </div>

    <div class="archive__collection">
        <table>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Clé</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($materials as $material): ?>
                <tr>
                    <td><?= $material['name'] ?></td>
                    <td><?= $material['description'] ?></td>
                    <td><?= $material['available'] ?></td>
                    <td><?= $material['require_key'] ? 'Oui' : 'Non' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>