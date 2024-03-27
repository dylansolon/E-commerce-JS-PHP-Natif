<section class="Cart">

    <div class="cartTitle">
        <h1>Panier</h1>
    </div>

    <?php if (count($panier)) { ?>
        <?php foreach ($panier as $item) { ?>
            <div id="id<?= $item['id'] ?>">
                <div class="cartContainer">
                    <div class="subCartContainer">
                        <img src="<?= PATH_IMAGE . $item['image'] ?>">
                        <div class="containerTitle">
                            <p><?= $item['name'] ?></p>
                            <span><?= $item['prix'] ?> €</span>
                        </div>
                        <div class="addIcon">
                            <button onclick="minusCart(<?= $item['id'] ?>)" type="button">-</button>
                            <span id='quantity-<?= $item['id'] ?>'><?= $item['quantité'] ?></span>
                            <button onclick="addCart(<?= $item['id'] ?>)" type="button">+</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="totalCart">
            <h3 id="total">Total : <?= $totalCart ?> €</h3>
            <?php
            if (!empty($_SESSION['panier'])) { ?>
                <form method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <button class="button" id="emptyCart" type="submit" name="viderPanier">Vider le panier</button>
                </form>
            <?php } else {
            } ?>
        </div>
    <?php } else { ?>
        <div class="emptyBack">
            <p>Votre panier est vide</p>
            <a href="<?php echo $redirectPage; ?>">
                <button id="back" class="button">Back</button>
            </a>
        </div>
    <?php } ?>
    </div>

    <div id="emptyManuallyCart">
        <?php
        if (isset($_SESSION['isLog']) && $_SESSION['isLog'] === true && !empty($_SESSION['panier'])) {
        ?>
            <form class="payForm" method='post'>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <button id="payer" class="button" type='submit' name='payer'>Payer</button>
            </form>
            <?php
        } else {
            if (!empty($_SESSION['panier'])) {
            ?>
                <p>Veuillez vous inscrire ou vous connecter pour continuer vos achats :</p>
                <div class="buttonContainer">
                    <a href='?page=login'>
                        <button class="button">Se connecter</button>
                    </a>
                    <a href='?page=register'>
                        <button class="button">S'inscrire</button>
                    </a>
                </div>
        <?php
            }
        }
        ?>
</section>

<script>

    function minusCart(product_id) {

        const form = new FormData();
        form.append("product_id", product_id);
        form.append("action", 'minus');

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
                document.querySelector('#nombreArticle').innerHTML = response.countPanier;
                document.querySelector('#nombreArticle1').innerHTML = response.countPanier;
                document.querySelector('#total').innerHTML = 'Total : ' + response.totalCart + ' €';

                if (response.newQuantity == 0) {
                    document.querySelector('#id' + product_id).remove();

                } else {
                    document.querySelector('#quantity-' + product_id).innerHTML = response.newQuantity;

                }
                if (response.countPanier == 0) {
                    document.querySelector(".totalCart").remove();
                    document.querySelector("#emptyManuallyCart").remove();
                    // Création de l'élément principal <div class="emptyBack">
                    const emptyBackDiv = document.createElement("div");
                    emptyBackDiv.classList.add("emptyBack");

                    // Création du paragraphe <p>Votre panier est vide</p>
                    const paragraph = document.createElement("p");
                    paragraph.textContent = "Votre panier est vide";

                    // Création du lien <a href="url">
                    const link = document.createElement("a");
                    link.href = "<?php echo $redirectPage; ?>";

                    // Création du bouton <button class="button">Back</button>
                    const button = document.createElement("button");
                    button.classList.add("button");
                    button.textContent = "Back";

                    // Ajout du bouton en tant qu'enfant du lien
                    link.appendChild(button);

                    // Ajout du paragraphe et du lien en tant qu'enfants de emptyBackDiv
                    emptyBackDiv.appendChild(paragraph);
                    emptyBackDiv.appendChild(link);

                    // Sélection de l'élément existant avec la classe "cartTitle"
                    const cartTitleElement = document.querySelector(".cartTitle");

                    // Insertion de emptyBackDiv après cartTitleElement
                    cartTitleElement.insertAdjacentElement('afterend', emptyBackDiv);



                } else {}
            })
            .catch(error => console.error('fetch error'));
    }

    function addCart(product_id) {

        console.log(product_id);

        const form = new FormData();
        form.append("product_id", product_id);
        form.append("action", 'add');

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
                document.querySelector('#nombreArticle').innerHTML = response.countPanier;
                document.querySelector('#nombreArticle1').innerHTML = response.countPanier;
                document.querySelector('#total').innerHTML = 'Total : ' + response.totalCart + ' €';
                document.querySelector('#quantity-' + product_id).innerHTML = response.newQuantity;

            })
            .catch(error => console.error('fetch error'));
    }
</script>