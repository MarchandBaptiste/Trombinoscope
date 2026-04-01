<?php 
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/admin.php';

$signInSuccess = false;
$sentence = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = db();

    // INSCRIPTION
    if (isset($_POST['signIn'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);

        $email_valid = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
        $login_valid = (
            !empty($login) &&
            strlen($login) >= 2 &&
            strlen($login) <= 16 &&
            preg_match('/^[a-zA-ZÀ-ÿ0-9\s\-]+$/', $login)
        );
        $role_valid = (!empty($role) && preg_match('/^[a-zA-ZÀ-ÿ0-9\s\-]+$/', $role));

        if (!$email_valid || !$login_valid || !$role_valid || empty($password)) {
            $sentence = 'Données manquantes ou invalides';
        } else {
            if (strlen($password) < 8) {
                $message = 'Le mot de passe doit comporter au moins 8 caractères';
            } elseif (!preg_match('/[A-Z]/', $password)) {
                $message = 'Le mot de passe doit contenir au moins une majuscule';
            } elseif (!preg_match('/[a-z]/', $password)) {
                $message = 'Le mot de passe doit contenir au moins une minuscule';
            } elseif (!preg_match('/[0-9]/', $password)) {
                $message = 'Le mot de passe doit contenir au moins un chiffre';
            } else {
                $hashed = password_hash($password, PASSWORD_BCRYPT);
                $result = setAdmin($db, $login, $email, $role, $hashed); 
                
                if ($result === true) {
                    $signInSuccess = true;
                    $sentence = 'Vous êtes inscrit !';
                } else {
                    $sentence = "L'inscription a échoué (login ou email déjà utilisé).";
                }
            }
        }
    }

    // CONNEXION
    if (isset($_POST['logIn'])) {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $log = getAdmin($db, $username, $password);
        if ($log) {
            $_SESSION['logged'] = $log;
            header('Location: /');
            exit();
        } else {
            $sentence = 'Identifiant ou mot de passe incorrect';
        }
    }
}
?>

<div class="divLog">

    <section class="log">
        <h3>Inscription</h3>

        <?php if (isset($_POST['signIn'])): ?>
            <?php if ($signInSuccess): ?>
                <p class="valid"><?= htmlspecialchars($sentence) ?></p>
            <?php elseif (!empty($sentence)): ?>
                <p class="error"><?= htmlspecialchars($sentence) ?></p>
            <?php endif; ?>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form">
                <div>
                    <label for="signIn_login">Identifiant :</label>
                    <input
                        type="text"
                        id="signIn_login"
                        name="login"
                        placeholder="Entrez un identifiant"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($login ?? '') : '' ?>"
                        required />
                </div>
                <div>
                    <label for="signIn_email">Email :</label>
                    <input
                        type="email"
                        id="signIn_email"
                        name="email"
                        placeholder="Entrez votre email"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($email ?? '') : '' ?>"
                        required />
                </div>
                <div>
                    <label for="signIn_role">Quel est votre rôle :</label>
                    <input
                        type="text"
                        id="signIn_role"
                        name="role"
                        placeholder="Entrez votre rôle"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($role ?? '') : '' ?>"
                        required />
                </div>
                <div>
                    <label for="signIn_password">Mot de passe :</label>
                    <input
                        type="password"
                        id="signIn_password"
                        name="password"
                        placeholder="Entrez un mot de passe"
                        required />
                </div>
                
                <?php if (isset($_POST['signIn']) && !empty($message)): ?>
                    <p class="error"><?= htmlspecialchars($message) ?></p>
                <?php endif; ?>

                <button type="submit" name="signIn">S'inscrire</button>
            </div>
        </form>
    </section>

    <section class="log">
        <h3>Connexion</h3>

        <?php if (!empty($_SESSION['logged'])): ?>
            <p class="valid">Vous êtes déjà connecté</p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form">
                <div>
                    <label for="logIn_username">Identifiant :</label>
                    <input
                        type="text"
                        id="logIn_username"
                        name="username"
                        placeholder="Entrez votre pseudo"
                        value="<?= isset($_POST['logIn']) ? htmlspecialchars($username ?? '') : '' ?>"
                        required />
                </div>
                <div>
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

                <button type="submit" name="logIn">Connexion</button>
            </div>
        </form>
    </section>

</div>

<?php include_once('../partials/footer.php'); ?>

