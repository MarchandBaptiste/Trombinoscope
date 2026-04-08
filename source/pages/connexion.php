<?php
$pageTitle = 'Connexion';
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/admin.php';

$signInSuccess = false;
$sentence = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = db();
    // CONNEXION
    if (isset($_POST['logIn'])) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $password = $_POST['password'] ?? '';

        $log = getAdmin($db, $username, $password);
        if ($log) {
            $_SESSION['logged'] = $log;
            header('Location: .//admin.php');
            exit();
        } else {
            $sentence = 'Identifiant ou mot de passe incorrect';
        }
    }
}
?>

<div class="upper-band">
    <h1>Authentification</h1>
</div>
<div class="page-inscription">
    <section class="inscription-wrapper">

        <?php if (!empty($_SESSION['logged'])): ?>
            <p class="valid">Vous êtes déjà connecté</p>
        <?php endif; ?>

        <form action="" class="formulaire" method="POST">
            <h2>Connexion</h2>
            <div>
                <div class="champs">
                    <label for="logIn_username">Identifiant :</label>
                    <input
                        type="text"
                        id="logIn_username"
                        name="username"
                        placeholder="Entrez votre pseudo"
                        value="<?= isset($_POST['logIn']) ? htmlspecialchars($username ?? '') : '' ?>"
                        required />
                </div>
                <div class="champs">
                    <label for="logIn_password">Mot de passe :</label>
                    <input
                        type="password"
                        id="logIn_password"
                        name="password"
                        placeholder="Entrez votre mot de passe"
                        required />
                </div>

                <?php if (isset($_POST['logIn']) && !empty($sentence)): ?>
                    <p class="error"><?= htmlspecialchars($sentence) ?></p>
                <?php endif; ?>

                <button type="submit" name="logIn" class="btn-cta">Connexion</button>
            </div>
        </form>
    </section>
</div>

<?php include_once('../partials/footer.php'); ?>