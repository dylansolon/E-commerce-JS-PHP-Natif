<section class="dashboard">
    <h1 class="dashboardAlert">Dashboard en cours de conception !</h1><br><br>

    <h1>Recap des ventes</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nom du Produit</th>
                <th>Prix (€)</th>
                <th>Date de Vente</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $chiffreAffaires = 0;

            foreach ($produits as $produit) {
                echo '<tr>
                        <td>' . $produit['name_product'] . '</td>
                        <td>' . $produit['prix'] . '</td>
                        <td>' . $produit['date'] . '</td>
                    </tr>';

                $chiffreAffaires += $produit['prix'];
            }
            ?>
        </tbody>
    </table><br>

    <div>
        <h2>Chiffre d'affaires</h2>
        <table border="1">
            <tr>
                <th>Total des ventes</th>
            </tr>
            <tr>
                <td><?php echo $chiffreAffaires . '€'; ?></td>
            </tr>
        </table>
    </div><br>

    <h2>Ajouter des produits</h2>
    <form method="POST" action="" enctype='multipart/form-data'>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <label for="">Nom du produit</label>
        <input type="text" name="name" value="<?= ($_SERVER['REQUEST_METHOD'] === 'POST') ? '' : htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : '') ?>"><br>
        <label for="">Prix du produit</label>
        <input type="text" name="prix" value="<?= ($_SERVER['REQUEST_METHOD'] === 'POST') ? '' : htmlspecialchars(isset($_POST['prix']) ? $_POST['prix'] : '') ?>"><br>
        <label for="">Insérez l'image du produit</label>
        <input type="file" name='image'><br>
        <label for="">Description</label>
        <input type="text" name="description" value="<?= ($_SERVER['REQUEST_METHOD'] === 'POST') ? '' : htmlspecialchars(isset($_POST['description']) ? $_POST['description'] : '') ?>">
        <select name='category_id'>
            <?php foreach ($categories as $categorie) { ?>
                <option value="<?= $categorie['id'] ?>"><?= $categorie['name'] ?></option>
            <?php } ?>
        </select><br><br>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_produit']) && !empty($message_erreur)) : ?>
            <div><?= $message_erreur ?></div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_produit']) && empty($message_erreur)) : ?>
            <div>Vous avez bien ajouté votre produit</div>
        <?php endif; ?>
        <button type="submit" name='ajouter_produit'>Ajouter</button>
    </form>

    <h2>Ajouter des categories</h2>
    <form method="POST" action="" enctype='multipart/form-data'>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <label for="">Nom de la categorie</label>
        <input type="text" name="name" value="<?= ($_SERVER['REQUEST_METHOD'] === 'POST') ? '' : htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : '') ?>"><br>
        <label for="">Insérez l'image du produit</label>
        <input type="file" name='image'><br>
        <label for="">Description</label>
        <input type="text" name="description" value="<?= ($_SERVER['REQUEST_METHOD'] === 'POST') ? '' : htmlspecialchars(isset($_POST['description']) ? $_POST['description'] : '') ?>"><br><br>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_categorie']) && !empty($message_erreur)) : ?>
            <div><?= $message_erreur ?></div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_categorie']) && empty($message_erreur)) : ?>
            <div>Vous avez bien ajouté votre produit</div>
        <?php endif; ?>
        <button type="submit" name='ajouter_categorie'>Ajouter</button>
    </form>
</section>