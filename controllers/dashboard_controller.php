<?php

if ($_SESSION['isAdmin'] === false) {
    echo '<script>window.location.href = "?page=home";</script>';
} else {

    $query = "SELECT * FROM sales";
    $response = $bdd->query($query);
    $produits = $response->fetchAll();

    $query = "SELECT * FROM categories";
    $response = $bdd->query($query);
    $categories = $response->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        if (isset($_POST["ajouter_produit"])) {

            // Vérifier si les types d'images sont autorisés
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'webp');
            $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if (!in_array($fileExtension, $allowedExtensions)) {
                $messageErreur = "Seuls les fichiers JPG, JPEG, PNG et WEBP sont autorisés.";
            } else {

                // Requête pour insérer les données du produit
                $query = "INSERT INTO produits (name, prix, description, category_id, quantité) VALUES (:name, :prix, :description, :category_id, 1)";
                $response = $bdd->prepare($query);
                $response->bindParam(':name', $_POST['name']);
                $response->bindParam(':prix', $_POST['prix']);
                $response->bindParam(':description', $_POST['description']);
                $response->bindParam(':category_id', $_POST['category_id']);
                $response->execute();

                $id = $bdd->lastInsertId();

                // Si l'insertion a réussi et qu'une image a été téléchargée
                if ($id && isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $uploadDir = 'assets/img/';
                    $imageName = basename($_FILES['image']['name']);
                    $imagePath = $uploadDir . $imageName;

                    // Déplacer l'image téléchargée vers le dossier de téléchargement
                    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

                    // Mettre à jour le champ 'image' dans la base de données avec le chemin de l'image
                    $sql = "UPDATE produits SET image = :image WHERE id = :id";
                    $stmt = $bdd->prepare($sql);
                    // $stmt->bindParam(':image', $imagePath);
                    $stmt->bindParam(':image', $imageName);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                }
            }
        }

        if (isset($_POST["ajouter_categorie"])) {

            // Vérifier si les types d'images sont autorisés pour les catégories
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'webp');
            $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if (!in_array($fileExtension, $allowedExtensions)) {
                $messageErreur = "Seuls les fichiers JPG, JPEG, PNG, et WEBP sont autorisés.";
            } else {

                $query = "INSERT INTO categories (name,description) VALUES (:name, :description)";
                $response = $bdd->prepare($query);
                $response->bindParam(':name', $_POST['name']);
                $response->bindParam(':description', $_POST['description']);
                $response->execute();

                $id = $bdd->lastInsertId();

                if ($id) {

                    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                        $uploadDir = 'assets/img/';
                        $imageName = basename($_FILES['image']['name']);
                        $imagePath = $uploadDir . $imageName;

                        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

                        $sql = "UPDATE categories set image = :image WHERE id = :id";
                        $stmt = $bdd->prepare($sql);
                        // $stmt->bindParam(':image', $imagePath);
                        $stmt->bindParam(':image', $imageName);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                    }
                }
            }
        }
    }
}

require './views/dashboard.php';
