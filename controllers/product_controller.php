<?php
$query = "SELECT * FROM produits WHERE category_id =:category_id";
$response = $bdd->prepare($query);
$response->execute([
    ':category_id' => $_GET['category_id']
]);
$produits = $response->fetchAll();

include 'views/product.php';
