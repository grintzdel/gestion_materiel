<?php
ob_start();
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
                    <!-- TODO: Add checkbox here -->
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

    </div>
</section>









<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>