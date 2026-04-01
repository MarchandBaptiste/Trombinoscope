<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/setStudent.php';
$db = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    // validation des champs
    $first_name_valid = (
        !empty(trim($first_name)) &&
        strlen($first_name) >= 2 &&
        strlen($first_name) <= 50 &&
        preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $first_name)
    );
    $last_name_valid = (
        !empty(trim($last_name)) &&
        strlen($last_name) >= 2 &&
        strlen($last_name) <= 50 &&
        preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $last_name)
    );
    // (bool) force a renvoyer un boolean
    $email_valid = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$first_name_valid || !$last_name_valid || !$email_valid) {
        $sentance = 'Données manquantes ou invalides';
        $singIn = false;
    } else {
        $user = setStudent($db, $first_name, $last_name, $email);
        if ($user === true) {
            $singIn   = true;
            $sentance = 'Vous êtes inscrit';
        } else {
            $singIn   = false;
            $sentance = "L'inscription a échoué";
        }
    }
}
?>
<h2>Ajouter un étudiant</h2>
<div class="divLog">
    <section class="log">
        <?php if (isset($_POST['signIn'])) { ?>
            <?php if ($singIn === true) { ?>
                <p class="valid"><?= $sentance ?></p>
            <?php } elseif (!empty($sentance)) { ?>
                <p class="error"><?= $sentance ?></p>
            <?php } ?>
        <?php } ?>
        <h3>Inscription</h3>
        <form action="" method="POST">
            <div class="form">
                <div>
                    <label for="first_name">Prénom : </label>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        placeholder="Entrez votre prénom"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($first_name ?? '') : '' ?>"
                        required />
                </div>
                <div>
                    <label for="last_name">Nom : </label>
                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        placeholder="Entrez votre nom"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($last_name ?? '') : '' ?>"
                        required>
                </div>
                <div>
                    <label for="email">Email : </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Entrez votre email"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($email ?? '') : '' ?>"
                        required />
                </div>
                <?php if (isset($_POST['signIn']) && !empty($message)) { ?>
                    <p class="error"><?= $message ?></p>
                <?php } ?>
                <button type="submit" name="signIn">S'inscrire</button>
            </div>
        </form>
    </section>
</div>

<?php include_once('../partials/footer.php'); ?>