<?php

$totalCart = 0;

if (!empty($_SESSION['panier'])) {
    $panier = $_SESSION['panier'];
    foreach ($panier as $item) {
        $totalCart += $item['quantité'] * $item['prix'];
    }
    echo json_encode(['totalCart' => $totalCart]);
} else {
    $panier = array();
}

// ---------- BUTTON BACK --------------

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

$categoryId = null;

if (preg_match('/\?page=product&category_id=(\d+)/', $referer, $matches)) {
    $categoryId = $matches[1];
}

$redirectPage = ($categoryId !== null) ? "?page=product&category_id=$categoryId" : '?page=home';

// ------------- VIDER PANIER ---------------

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['viderPanier']) && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    unset($_SESSION['panier']);

    echo '<script>window.location.href = "?page=home";</script>';

    $_SESSION['status'] = 'success';
    $_SESSION['message'] = "Le Panier est vide !";
    exit;
}

// --------------- REQUETE PAYER ------------------

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payer']) && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    $panier = $_SESSION['panier'];

    $name = '';
    $prix = 0;

    foreach ($panier as $produit) {

        $name = $produit['name'];
        $prix = $produit['prix'];

        $query = "INSERT INTO sales (name_product, prix, date) VALUES (:name, :prix, NOW())";
        $response = $bdd->prepare($query);
        $response->execute([
            'name' => $name,
            'prix' => $prix,
        ]);
    }

    unset($_SESSION['panier']);
    $_SESSION['status'] = 'success';
    $_SESSION['message'] = "Merci pour votre achat !";

    echo '<script>window.location.href = "?page=home";</script>';

    exit();
}

require './views/panier.php';
