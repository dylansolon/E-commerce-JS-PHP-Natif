<?php
require 'include/env.php';
require 'include/db-connect.php';

$availableRoutes = ['home', 'product', 'login', 'register', 'panier', 'dashboard'];

$route = 'home';
if (isset($_GET['page']) and in_array($_GET['page'], $availableRoutes)) {
    $route = $_GET['page'];
}

require 'views/layout.php';
