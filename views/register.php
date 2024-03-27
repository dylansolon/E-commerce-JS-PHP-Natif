<div class="logRegSection">
    <div class="logContainer">
        <div class="form-box">

            <form method="post" action="" class="registerForm" name="registerForm">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                <h2>Inscription</h2>
                <div class="input-box">
                    <input type="text" name="name" value="<?= ($_SERVER['REQUEST_METHOD'] === 'POST') ? '' : htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : '') ?>" required>
                    <label>Nom</label>
                    <i class="ri-user-fill"></i>
                </div>
                <div class="input-box">
                    <input type="email" name="mail" value="<?= ($_SERVER['REQUEST_METHOD'] === 'POST') ? '' : htmlspecialchars(isset($_POST['mail']) ? $_POST['mail'] : '') ?>" required>
                    <label>Email</label>
                    <i class="ri-mail-fill"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Mot de passe</label>
                    <i class="ri-lock-2-fill"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password_confirmation" required>
                    <label>Confirmer mot de passe</label>
                    <i class="ri-lock-2-fill"></i>
                </div>
                <button type="submit" class="btn">Vous inscrire</button>
                <div class="account-creation">
                    <span>Vous avez déjà un compte ? </span>
                    <a href="?page=login" class="loginLink">Se connecter</a>
                </div>
            </form>

        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($errors)) {
        echo '<div class="error-message">';
        foreach ($errors as $error) {
            echo '<h4>' . htmlspecialchars($error) . '</h4>';
        }
        echo '</div>';
    }
    ?>

</div>