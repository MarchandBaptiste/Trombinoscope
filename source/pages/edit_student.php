<?php
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/modifyStudent.php';
$studentId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if ($studentId === null) {
    header("Location: ../pages/home.php");
    exit;
}
$db = db();
$studentData = studentSet($db, $studentId);
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

    if (!$first_name_valid || !$last_name_valid || !$email_valid || $studentId === null) {
        $sentance = 'Données manquantes ou invalides';
        $modify = false;
    } else {
        $user = modifyStudent($db, $studentId, $first_name, $last_name, $email);
        if ($user === true) {
            $modify   = true;
            $sentance = 'Modification effectuer avec sucess';
        } else {
            $modify   = false;
            $sentance = "Les modifications on échouées";
        }
    }
}
?>
<h2>Modifier un étudiant</h2>
<div class="divLog">
    <section class="log">
        <form action="" method="POST">
            <div class="form">
                <div>
                    <label for="first_name">Prénom : </label>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        placeholder="Entrez votre prénom"
                        value="<?= $studentData['first_name'] ?? '' ?>"
                        required />
                </div>
                <div>
                    <label for="last_name">Nom : </label>
                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        placeholder="Entrez votre nom"
                        value="<?= $studentData['last_name'] ?? '' ?>"
                        required>
                </div>
                <div>
                    <label for="email">Email : </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Entrez votre email"
                        value="<?= $studentData['email'] ?? '' ?>"
                        required />
                </div>
                <button type="submit" name="modify">Modifier</button>
                <p><?= $sentance ?? '' ?></p>
            </div>
        </form>
    </section>
</div>
<?php include_once('../partials/footer.php');
?>