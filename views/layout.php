<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBurger</title>
    <link rel="stylesheet" href="./assets/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    <?php
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    if (!isset($_SESSION['isLog'])) {
        $_SESSION['isLog'] = false;
    }
    if (!isset($_SESSION['isAdmin'])) {
        $_SESSION['isAdmin'] = false;
    }
    ?>
    <?php
    require 'include/header.php';
    ?>



    <script>
        let addPanierButton = document.querySelector('.addPanierButton');
        let nombreArticleElement = document.getElementById('nombreArticle');
        let nombreArticleElement1 = document.getElementById('nombreArticle1');

        function addToCart(product_id) {

            const form = new FormData();
            form.append("product_id", product_id);
            form.append("action", 'addtoCart');
            form.append("csrf_token", '<?= $_SESSION['csrf_token'] ?>');

            const headers = {
                'Accept': 'application/json'
            }
            const apiCall = fetch('controllers/product_controller_fetch.php', {
                    method: 'POST',
                    headers: headers,
                    body: form,
                })
                .then(response => response.json())
                .then(response => {
                    nombreArticleElement.innerHTML = response.countPanier;
                    nombreArticleElement1.innerHTML = response.countPanier;
                })
                .catch(error => console.error('fetch error'));
        }
    </script>

    <main>
        <?php require './controllers/' . $route . '_controller.php'; ?>
    </main>

    <script>
        <?php if (!empty($_SESSION['status'])) { ?>
            toastr.options = {
                "positionClass": "toast-top-center",
            }
            toastr.<?= $_SESSION['status'] ?>("<?= $_SESSION['message'] ?>")
        <?php }
        unset($_SESSION['status']);
        unset($_SESSION['message']);
        ?>
    </script>

    <?php
    require 'include/footer.php';
    ?>

    <script src="./assets/script.js"></script>
</body>

</html>