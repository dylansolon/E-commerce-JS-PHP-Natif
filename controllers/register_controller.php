<?php

if (
    $_SESSION['isLog'] === true ||
    $_SESSION['isAdmin'] === true
) {
    echo '<script>window.location.href = "?page=home";</script>';
} else {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];

        $errors = [];

        if ($name === '' || $password === '' || $mail === '' || $password_confirmation === '') {
            $errors[] = "- Tous les champs doivent être remplis.";
        } else {

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "- L'adresse e-mail n'est pas valide.";
            }

            if (strlen($password) < 8) {
                $errors[] = "- Le mot de passe doit contenir au moins 8 caractères.";
            }


            if ($password !== $password_confirmation) {
                $errors[] = "- Les mots de passe ne correspondent pas.";
            }
        }

        if (is_array($errors) && count($errors) === 0) {

            $checkEmailQuery = "SELECT COUNT(*) FROM user WHERE mail = :mail";
            $checkEmailResponse = $bdd->prepare($checkEmailQuery);
            $checkEmailResponse->execute([':mail' => $mail]);

            if ($checkEmailResponse->fetchColumn() > 0) {
                $errors[] = "- L'e-mail est déjà utilisé. Veuillez choisir un autre e-mail.";
            } else {

                $_SESSION['name'] = $name;

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $role = 'customer';

                $query = "INSERT INTO user (name, mail, password, role) VALUES (:name, :mail, :password, :role)";
                $response = $bdd->prepare($query);
                $response->execute([
                    ':name' => $_POST['name'],
                    ':mail' => $_POST['mail'],
                    ':password' => $hashedPassword,
                    ':role' => $role,
                ]);

                $_SESSION['isLog'] = true;

                $_SESSION['status'] = 'success';
                $_SESSION['message'] = "Vous êtes bien inscrit !";

                echo '<script>window.location.href = "?page=home";</script>';
                exit;
            }
        }
    }
}

require './views/register.php';
