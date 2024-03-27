<?php

$totalQuantity = 0;
// Vérifie si le panier existe dans la session
if (isset($_SESSION['panier'])) {
    // Parcours de chaque article dans le panier
    foreach ($_SESSION['panier'] as $item) {
        // Ajout de la quantité de cet article à la quantité totale
        $totalQuantity += $item['quantité'];
    }
}
?>

<header class="header">
    <div class="containerHeader">
        <div class="cart__menu">
            <a href="?page=panier">
                <i class="ri-shopping-cart-line"></i>
                <div id="" class="cart__indicator">
                    <span id="nombreArticle"><?= '<span id="nombreArticle">' . $totalQuantity . '</span>'; ?></span>
                </div>
            </a>
        </div>
        <a href="?page=home"><img src="./assets/img/logo1.png" class="logoHeader" alt=""></a>
        <nav>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <?php if (isset($_SESSION['isLog']) && $_SESSION['isLog'] === true) { ?>
                        <h3 style="display:flex; align-items: center;">
                            Bonjour <?= isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : '' ?>
                        </h3>
                    <?php } ?>
                    <li>
                        <a href="?page=home" class="nav__link">
                            Accueil
                        </a>
                    </li>
                    <?php if (isset($_SESSION['isLog']) && $_SESSION['isLog'] === true) {
                        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) { ?>
                            <li>
                                <a href="?page=dashboard" class="nav__link">
                                    Dashboard
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="?page=login&action=logout" class="nav__link">
                                Se déconnecter
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="?page=login" class="nav__link">
                                Se connecter
                            </a>
                        </li>
                        <li>
                            <a href="?page=register" class="nav__link">
                                S'inscrire
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="?page=panier" class="nav__link" id="nav__link">
                            <div id="">Panier : <span id="nombreArticle1"><?= '<span id="nombreArticle">' . $totalQuantity . '</span>'; ?></span></div>
                        </a>
                    </li>
                </ul>
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>
            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-menu-line"></i>
            </div>
        </nav>
    </div>
</header>
