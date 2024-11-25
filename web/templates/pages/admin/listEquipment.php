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
                        <li class="filter__list__item">
                            <input type="radio" id="availability-all" name="availability" checked>
                            <label for="availability-all">Tout</label>
                        </li>
                        <li class="filter__list__item">
                            <input type="radio" id="availability-true" name="availability">
                            <label for="availability-true">Disponible</label>
                        </li>
                        <li class="filter__list__item">
                            <input type="radio" id="availability-false" name="availability">
                            <label for="availability-false">Indisponible</label>
                        </li>
                    </ul>
                </div>
            </details>
        </div>

        <!-- Collection -->
        <div class="archive__collection">
            <?php foreach ($materials as $material): ?>
                <div class="equipment">
                    <div class="equipment__image">
                        <img src="<?= $material['image'] ?>" alt="<?= $material['name'] ?>">
                    </div>
                    <div class="equipment__content">
                        <h2 class="equipment__content__title"><?= $material['name'] ?></h2>
                        <p>Disponible : <?= $material['available'] ?> / <?= $material['total'] ?></p>
                        <a href="#"
                           class="button <?php if ($material['available'] > 0) : ?> button--primary
                            <?php else : ?> button--secondary <?php endif; ?>"><?php if ($material['available'] > 0) : ?>
                                Disponible
                            <?php else : ?> Indisponible <?php endif; ?>
                        </a>
                        <a href="/admin/equipment/edit?id_equipment=<?= $material['id_equipment'] ?>" class="button button--primary">Modifier</a>
                        <a href="/admin/equipment/delete?id_equipment=<?= $material['id_equipment'] ?>" class="button button--primary">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>