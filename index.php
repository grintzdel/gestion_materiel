<?php require_once 'src/views/partials/head.php'; ?>

    <section class="hero">
        <div class="hero__heading">
            <h1 class="hero__heading--base">pécho ton</h1>
            <h1 class="hero__heading--highlight">matos</h1>
            <h1 class="hero__heading--base">by</h1>
            <picture>
                <source srcset="src/public/svg/logo__mmi__desktop.svg" media="(min-width: 768px)">
                <img src="src/public/svg/logo_mmi__mobile.svg" alt="Logo MMI Chambéry">
            </picture>
        </div>
        <div class="hero__card">
            <h2 class="hero__card__title">Comment ça marche ?</h2>
            <p class="hero__card__description">Choisir son matériel et sélectionner une <strong>date</strong> et une
                <strong>période</strong>.</p>
            <p class="hero__card__description">Dans le panier, vérifier et <strong>valider</strong> la demande.</p>
            <p class="hero__card__description">La demande est envoyée au responsable. En cas de <strong>refus</strong>,
                un mail sera envoyé.</p>
        </div>
    </section>

<?php require_once 'src/views/partials/footer.php'; ?>