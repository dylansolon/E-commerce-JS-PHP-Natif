<main class="logRegSection">
    <div class="loginLog">
        <p>pour acceder au dashboard :</p>
        <p>Adresse e-mail : admin@admin.com</p>
        <p>Mot de passe : password</p>
    </div>
    <div class="logContainer">
        <div class="form-box">
            <form method="post" action="" class="loginForm" name="loginForm">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <h2>Se connecter</h2>
                <div class="input-box">
                    <input type="email" name="mail" value="<?= ($_SERVER['REQUEST_METHOD'] === 'POST') ? '' : htmlspecialchars(isset($_POST['mail']) ? $_POST['mail'] : '') ?>" required>
                    <label>Email</label>
                    <i class="ri-user-fill"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Mot de passe</label>
                    <i class="ri-lock-2-fill"></i>
                </div>
                <div class="forget-section">
                    <p>
                        <input type="checkbox" checked>
                        Se souvenir de moi
                    </p>
                    <a href="">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn1">Sign in</button>
                <div class="account-creation">
                    <span>Vous n'avez pas de compte ?</span>
                    <a href="?page=register" class="registerLink">S'incrire</a>
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
</main>