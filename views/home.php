<main>
    <section>
        <div class="categorieContainer">
            <?php

            foreach ($categories as $data) {
            ?>

                <div class='cardContainer'>
                    <h2><?= $data['name'] ?> </h2>
                    <img src="<?= PATH_IMAGE . $data['image'] ?>" alt="<?= $data['name'] ?>">
                    <p> <?= $data['description'] ?> </p>
                    <a href='?page=product&category_id=<?= $data['id'] ?>'><button class="button">Tous nos produits</button></a>
                </div>
            <?php } ?>
        </div>
    </section>
</main>