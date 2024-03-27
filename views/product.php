<section>
    <div class="categorieContainerProduct">
        <?php
        foreach ($produits as $data) {
        ?>
            <div class="cardContainer">
                <h2><?= $data['name'] ?> - <?= $data['prix'] ?> €</h2>

                <img src="<?= PATH_IMAGE . $data['image'] ?>" alt="<?= $data['name'] ?>">
                <p><?= $data['description'] ?> </p>
                <button class='addPanierButton button' onclick="addToCart(<?= $data['id'] ?>)">Ajouter au panier</button>
            </div>
        <?php } ?>
    </div>
</section>