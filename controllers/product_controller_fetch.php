<?php
require '../include/env.php';
require '../include/db-connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] === 'addtoCart' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    // Vérifie si le panier existe dans la session, sinon initialise-le
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    $productId = $_POST['product_id'];

    // Vérifie si le produit existe déjà dans le panier
    $productIndex = array_search($productId, array_column($_SESSION['panier'], 'id'));

    if ($productIndex !== false) {
        // Le produit existe déjà dans le panier, incrémente la quantité
        $_SESSION['panier'][$productIndex]['quantité']++;
    } else {
        // Le produit n'existe pas encore dans le panier, récupère ses détails depuis la base de données
        $query = "SELECT * FROM produits WHERE id = :id";
        $response = $bdd->prepare($query);
        $response->execute([':id' => $productId]);
        $data = $response->fetch();

        // Ajoute le produit avec une quantité de 1 au panier
        $data['quantité'] = 1;
        $_SESSION['panier'][] = $data;
    }
    // Calcul du nombre total d'articles dans le panier
    $totalArticles = 0;
    foreach ($_SESSION['panier'] as $item) {
        $totalArticles += $item['quantité'];
    }

    // Retourne le nombre total d'articles dans le panier sous forme de réponse JSON
    echo json_encode(['countPanier' => $totalArticles]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] === 'minus') {

    $panier = $_SESSION['panier'];

    $indexRemove = null;

    for ($i = 0; $i < count($panier); $i++) {
        if ($panier[$i]['id'] == $_POST['product_id']) {
            $panier[$i]['quantité']--;
            $newQuantity = $panier[$i]['quantité'];
            if ($newQuantity == 0) {
                $indexRemove = $i;
            }
            break;
        }
    }

    if ($indexRemove !== null) {
        array_splice($panier, $indexRemove, 1);
    }

    $_SESSION['panier'] = $panier;

    // Calcul du nombre total d'articles dans le panier
    $totalArticles = 0;
    foreach ($_SESSION['panier'] as $item) {
        $totalArticles += $item['quantité'];
    }

    $totalCart = 0;
    if (!empty($_SESSION['panier'])) {
        $panier = $_SESSION['panier'];
        foreach ($panier as $item) {
            $totalCart += $item['quantité'] * $item['prix'];
        }
    } else {
        $panier = array();
    }

    // Retourne le nombre total d'articles dans le panier et la nouvelle quantité sous forme de réponse JSON
    echo json_encode(['countPanier' => $totalArticles, 'newQuantity' => $newQuantity, 'totalCart' => $totalCart]);

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] === 'add') {

    $panier = $_SESSION['panier'];

    $indexRemove = null;

    for ($i = 0; $i < count($panier); $i++) {
        if ($panier[$i]['id'] == $_POST['product_id']) {
            $panier[$i]['quantité']++;
            $newQuantity = $panier[$i]['quantité'];
            if ($newQuantity == 0) {
                $indexRemove = $i;
            }
            break;
        }
    }

    if ($indexRemove !== null) {
        array_splice($panier, $indexRemove, 1);
    }

    $_SESSION['panier'] = $panier;

    // Calcul du nombre total d'articles dans le panier
    $totalArticles = 0;
    foreach ($_SESSION['panier'] as $item) {
        $totalArticles += $item['quantité'];
    }

    $totalCart = 0;
    if (!empty($_SESSION['panier'])) {
        $panier = $_SESSION['panier'];
        foreach ($panier as $item) {
            $totalCart += $item['quantité'] * $item['prix'];
        }
    } else {
        $panier = array();
    }

    // Retourne le nombre total d'articles dans le panier et la nouvelle quantité sous forme de réponse JSON
    echo json_encode(['countPanier' => $totalArticles, 'newQuantity' => $newQuantity, 'totalCart' => $totalCart]);

}
