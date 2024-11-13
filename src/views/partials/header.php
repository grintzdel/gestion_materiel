<?php
$current_page = basename($_SERVER['PHP_SELF']);
$beforeLink = '../';
$beforeLinkNav = '';
if ($current_page === 'index.php') {
    $beforeLink = 'views/';
    $beforeLinkNav = 'views/pages/';
}
?>

<header class="header">
    <div class="header__button">
        <div class="header__button--toggle">
            <span></span>
        </div>
    </div>
    <div class="header__nav">
        <div class="header__nav__menu">
            <div class="header__nav__menu__list">
                <div class="header__nav__menu__list__items">
                    <div class="header__nav__menu__list__items__item">
                        <a href="<?= $current_page === 'index.php' ? '#' : '../../../index.php' ?>">How ?</a>
                        <div class="header__nav__menu__list__items__item__wrapper"></div>
                    </div>
                    <div class="header__nav__menu__list__items__item">
                        <a href="<?= $beforeLinkNav . 'profil.php' ?>">Profil</a>
                        <div class="header__nav__menu__list__items__item__wrapper"></div>
                    </div>
                    <div class="header__nav__menu__list__items__item">
                        <a href="<?= $beforeLinkNav . 'panier.php' ?>">Panier</a>
                        <div class="header__nav__menu__list__items__item__wrapper"></div>
                    </div>
                    <div class="header__nav__menu__list__items__item">
                        <details open>
                            <summary>Equipements</summary>
                            <ul>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=tout' ?>">Tout</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=appareils-photo' ?>">Appareils photo</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=cameras' ?>">Caméras</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=micros' ?>">Micros</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=enregistreurs' ?>">Enregistreurs</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=cables' ?>">Câbles</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=adaptateurs' ?>">Adaptateurs</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=casques' ?>">Casques</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=trepieds' ?>">Trépieds</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=eclairages' ?>">Eclairages</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=perches' ?>">Perches</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=moniteurs' ?>">Moniteurs</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=objectifs-photo' ?>">Objectifs photo</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=ordinateurs' ?>">Ordinateurs</a></li>
                                <li><a href="<?= $beforeLinkNav . 'equipements.php?type=autres' ?>">Autres</a></li>
                            </ul>
                        </details>
                        <div class="header__nav__menu__list__items__item__wrapper"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>