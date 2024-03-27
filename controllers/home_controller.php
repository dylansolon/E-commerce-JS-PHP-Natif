<?php
$query = "SELECT * FROM categories";
$response = $bdd->query($query);
$categories = $response->fetchAll();

require './views/home.php';
