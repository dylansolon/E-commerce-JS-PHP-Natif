<?php
    // -------------------- LOGOUT ------------------------

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'logout') {

        $_SESSION['isLog'] = false;
        $_SESSION['isAdmin'] = false;
        unset($_SESSION['name']);
        unset($_SESSION['panier']);
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = "Vous êtes deconnecté";

        echo '<script>window.location.href = "?page=home";</script>';
        exit();
    }


    //---------------------- LOGIN ------------------------
    if ($_SESSION['isLog'] === true || $_SESSION['isAdmin'] === true) {
        echo '<script>window.location.href = "?page=home";</script>';
    } else {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

        $mail = $_POST['mail'];
        $password = $_POST['password'];

        $query = $bdd->prepare("SELECT * FROM user WHERE mail = :mail");
        $query->bindParam(':mail', $mail);

        $query->execute();
        $user = $query->fetch();

        $errors = [];

        if (!$user or !password_verify($password, $user['password'])) {
            $errors[] = "Les identifiants sont incorrects !";
        } else {
            $_SESSION['name'] = $user['name'];
            $_SESSION['isLog'] = true;
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = "Vous êtes connecté";

            $role = $user['role'];

            // Vérifier si l'utilisateur a le rôle d'administrateur
            if ($role === 'admin') {
                $_SESSION['isAdmin'] = true;
            } else {
                $_SESSION['isAdmin'] = false;
            }
        }

        if (empty($errors)) {
            // Aucune erreur, redirection vers la page d'accueil
            echo '<script>window.location.href = "?page=home";</script>';
            exit;
        }
    }
}

require './views/login.php';
